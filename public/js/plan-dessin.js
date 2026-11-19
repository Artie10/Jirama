(function () {
    function initialiserPlan(root) {
        if (root.dataset.initialise === '1') return;
        root.dataset.initialise = '1';

        const canvas = root.querySelector('.et-plan-canvas');
        const ctx = canvas.getContext('2d');
        const champJson = root.querySelector('[data-plan-json]');
        const champImage = root.querySelector('[data-plan-image]');
        const inputPhoto = root.querySelector('[data-photo]');
        const nomPhoto = root.querySelector('[data-photo-nom]');
        const indication = root.querySelector('[data-indication]');

        const labels = {
            depart: canvas.dataset.labelDepart,
            arrivee: canvas.dataset.labelArrivee,
        };

        let photo = null;
        let outil = 'crayon';
        let traitCourant = null;
        let historique = [];

        let etat = {
            traits: [],
            depart: null,
            arrivee: null,
        };

        try {
            const ancien = JSON.parse(champJson.value || 'null');

            if (ancien) {
                etat.traits = ancien.traits || [];
                etat.depart = ancien.depart || null;
                etat.arrivee = ancien.arrivee || null;
            }
        } catch (e) {
            console.warn('Plan précédent illisible', e);
        }

        function copierEtat() {
            historique.push(JSON.stringify(etat));
            if (historique.length > 50) historique.shift();
        }

        function ajusterCanvas() {
            const rect = canvas.getBoundingClientRect();
            if (!rect.width || !rect.height) return;

            const ratio = window.devicePixelRatio || 1;

            canvas.width = Math.round(rect.width * ratio);
            canvas.height = Math.round(rect.height * ratio);

            ctx.setTransform(ratio, 0, 0, ratio, 0, 0);
            dessiner();
        }

        function dessinerPhoto() {
            const w = canvas.clientWidth;
            const h = canvas.clientHeight;

            if (!photo) return;

            // Affichage de la photo entière sans la déformer.
            const ratio = Math.min(w / photo.width, h / photo.height);
            const largeur = photo.width * ratio;
            const hauteur = photo.height * ratio;

            const x = (w - largeur) / 2;
            const y = (h - hauteur) / 2;

            ctx.drawImage(photo, x, y, largeur, hauteur);
        }

        function tracerTrait(trait, w, h) {
            if (!trait.p || !trait.p.length) return;

            const points = trait.p;

            ctx.beginPath();
            ctx.moveTo(points[0][0] * w, points[0][1] * h);

            points.slice(1).forEach((point) => {
                ctx.lineTo(point[0] * w, point[1] * h);
            });

            if (points.length === 1) {
                ctx.lineTo(points[0][0] * w + 0.1, points[0][1] * h);
            }

            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';

            if (trait.passage) {
                // Terrain de passage : large bande orange
                ctx.strokeStyle = 'rgba(234, 88, 12, 0.35)';
                ctx.lineWidth = Math.max(18, w / 22);
                ctx.setLineDash([]);
                ctx.stroke();

                // Contour orange pour délimiter le passage
                ctx.beginPath();
                ctx.moveTo(points[0][0] * w, points[0][1] * h);

                points.slice(1).forEach((point) => {
                    ctx.lineTo(point[0] * w, point[1] * h);
                });

                ctx.strokeStyle = '#ea580c';
                ctx.lineWidth = 1.5;
                ctx.setLineDash([6, 5]);
                ctx.stroke();
            } else {
                // Conduite d'eau : ligne bleue technique
                ctx.strokeStyle = '#0369a1';
                ctx.lineWidth = Math.max(3, w / 250);
                ctx.setLineDash([]);
                ctx.stroke();
            }

            ctx.setLineDash([]);
        }

        function marqueur(position, couleur, texte, maison = false) {
            if (!position) return;

            const w = canvas.clientWidth;
            const h = canvas.clientHeight;
            const x = position[0] * w;
            const y = position[1] * h;
            const r = Math.max(8, w / 90);

            ctx.beginPath();

            if (maison) {
                ctx.moveTo(x, y - r);
                ctx.lineTo(x + r, y);
                ctx.lineTo(x + r * 0.7, y);
                ctx.lineTo(x + r * 0.7, y + r);
                ctx.lineTo(x - r * 0.7, y + r);
                ctx.lineTo(x - r * 0.7, y);
                ctx.lineTo(x - r, y);
                ctx.closePath();
            } else {
                ctx.arc(x, y, r, 0, Math.PI * 2);
            }

            ctx.fillStyle = couleur;
            ctx.fill();
            ctx.lineWidth = 2;
            ctx.strokeStyle = '#fff';
            ctx.stroke();

            ctx.font = '600 13px Arial';
            ctx.textBaseline = 'middle';
            ctx.textAlign = 'left';
            ctx.lineWidth = 4;
            ctx.strokeStyle = '#fff';
            ctx.strokeText(texte, x + r + 6, y);
            ctx.fillStyle = couleur;
            ctx.fillText(texte, x + r + 6, y);
        }

        function dessiner() {
            const w = canvas.clientWidth;
            const h = canvas.clientHeight;

            ctx.clearRect(0, 0, w, h);

            // Fond quadrillé
            ctx.fillStyle = '#fff';
            ctx.fillRect(0, 0, w, h);

            if (photo) {
                dessinerPhoto();
            } else {
                ctx.strokeStyle = '#e5e7eb';
                ctx.lineWidth = 1;

                for (let x = 0; x < w; x += 24) {
                    ctx.beginPath();
                    ctx.moveTo(x, 0);
                    ctx.lineTo(x, h);
                    ctx.stroke();
                }

                for (let y = 0; y < h; y += 24) {
                    ctx.beginPath();
                    ctx.moveTo(0, y);
                    ctx.lineTo(w, y);
                    ctx.stroke();
                }
            }

            etat.traits.filter((t) => t.passage).forEach((t) => tracerTrait(t, w, h));

            etat.traits.filter((t) => !t.passage).forEach((t) => tracerTrait(t, w, h));

            marqueur(etat.depart, '#2563eb', labels.depart);
            marqueur(etat.arrivee, '#16a34a', labels.arrivee, true);
        }

        function sauvegarder() {
            champJson.value = JSON.stringify(etat);

            const exportCanvas = document.createElement('canvas');
            const largeur = 1200;
            const hauteur = Math.round((largeur * canvas.clientHeight) / canvas.clientWidth);

            exportCanvas.width = largeur;
            exportCanvas.height = hauteur;

            const exportCtx = exportCanvas.getContext('2d');
            exportCtx.scale(largeur / canvas.clientWidth, hauteur / canvas.clientHeight);

            // Export de la photo et du dessin ensemble.
            const ancienCtx = ctx;
            const image = document.createElement('canvas');
            image.width = canvas.width;
            image.height = canvas.height;

            image.getContext('2d').drawImage(canvas, 0, 0);

            exportCtx.drawImage(image, 0, 0, canvas.clientWidth, canvas.clientHeight);

            champImage.value = exportCanvas.toDataURL('image/png');
        }

        function position(e) {
            const rect = canvas.getBoundingClientRect();

            return [
                Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width)),
                Math.max(0, Math.min(1, (e.clientY - rect.top) / rect.height)),
            ];
        }

        function choisirOutil(nom) {
            outil = nom;

            root.querySelectorAll('[data-outil]').forEach((btn) => {
                btn.classList.toggle('is-actif', btn.dataset.outil === nom);
            });
        }

        canvas.addEventListener('pointerdown', function (e) {
            e.preventDefault();
            canvas.setPointerCapture(e.pointerId);

            const p = position(e);

            if (outil === 'depart' || outil === 'arrivee') {
                copierEtat();
                etat[outil] = p;
                choisirOutil('crayon');
                dessiner();
                sauvegarder();
                return;
            }

            copierEtat();

            traitCourant = {
                p: [p],
                passage: outil === 'passage',
            };

            etat.traits.push(traitCourant);
            dessiner();
        });

        canvas.addEventListener('pointermove', function (e) {
            if (!traitCourant) return;

            e.preventDefault();
            traitCourant.p.push(position(e));
            dessiner();
        });

        function terminerDessin() {
            if (!traitCourant) return;

            traitCourant = null;
            sauvegarder();
        }

        canvas.addEventListener('pointerup', terminerDessin);
        canvas.addEventListener('pointercancel', terminerDessin);
        canvas.addEventListener('lostpointercapture', terminerDessin);

        root.querySelectorAll('[data-outil]').forEach((btn) => {
            btn.addEventListener('click', () => choisirOutil(btn.dataset.outil));
        });

        root.querySelector('[data-action="annuler"]').addEventListener('click', () => {
            if (!historique.length) return;

            etat = JSON.parse(historique.pop());
            dessiner();
            sauvegarder();
        });

        root.querySelector('[data-action="effacer"]').addEventListener('click', () => {
            if (!confirm('Effacer tout le plan ?')) return;

            copierEtat();
            etat = { traits: [], depart: null, arrivee: null };
            dessiner();
            sauvegarder();
        });

        inputPhoto.addEventListener('change', function () {
            const fichier = this.files[0];
            if (!fichier) return;

            if (!['image/jpeg', 'image/png', 'image/webp'].includes(fichier.type)) {
                alert('Choisissez une image JPG, PNG ou WEBP.');
                this.value = '';
                return;
            }

            const lecteur = new FileReader();

            lecteur.onload = function (event) {
                const nouvellePhoto = new Image();

                nouvellePhoto.onload = function () {
                    copierEtat();
                    photo = nouvellePhoto;
                    nomPhoto.textContent = fichier.name;
                    indication.hidden = true;
                    ajusterCanvas();
                    sauvegarder();
                };

                nouvellePhoto.src = event.target.result;
            };

            lecteur.readAsDataURL(fichier);
        });

        if (window.ResizeObserver) {
            new ResizeObserver(ajusterCanvas).observe(canvas);
        } else {
            window.addEventListener('resize', ajusterCanvas);
        }

        if (champJson.value) {
            sauvegarder();
        }

        ajusterCanvas();
    }

    function initialiserTous() {
        document.querySelectorAll('[data-plan-dessin]').forEach(initialiserPlan);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initialiserTous);
    } else {
        initialiserTous();
    }
})();
