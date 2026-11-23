(function () {
    function initialiserPlan(root) {
        if (root.dataset.initialise === '1') return;
        root.dataset.initialise = '1';

        const canvas = root.querySelector('.et-plan-canvas');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');

        const champJson = root.querySelector('[data-plan-json]');
        const champImage = root.querySelector('[data-plan-image]');
        const inputPhoto = root.querySelector('[data-photo]');
        const nomPhoto = root.querySelector('[data-photo-nom]');
        const indication = root.querySelector('[data-indication]');

        const formulaire = root.closest('form');

        const labels = {
            depart: canvas.dataset.labelDepart || "Source d'eau",
            arrivee: canvas.dataset.labelArrivee || 'Maison',
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

        // Restaurer les données JSON existantes
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

        // Conserver un état pour la fonction Annuler
        function copierEtat() {
            historique.push(JSON.stringify(etat));

            if (historique.length > 50) {
                historique.shift();
            }
        }

        // Adapter le canvas à sa taille réelle
        function ajusterCanvas() {
            const rect = canvas.getBoundingClientRect();

            if (!rect.width || !rect.height) return;

            const ratio = window.devicePixelRatio || 1;

            canvas.width = Math.round(rect.width * ratio);
            canvas.height = Math.round(rect.height * ratio);

            ctx.setTransform(ratio, 0, 0, ratio, 0, 0);

            dessiner();
            sauvegarder();
        }

        // Dessiner la photo sans la déformer
        function dessinerPhoto() {
            const w = canvas.clientWidth;
            const h = canvas.clientHeight;

            if (!photo) return;

            const ratio = Math.min(w / photo.width, h / photo.height);

            const largeur = photo.width * ratio;
            const hauteur = photo.height * ratio;

            const x = (w - largeur) / 2;
            const y = (h - hauteur) / 2;

            ctx.drawImage(photo, x, y, largeur, hauteur);
        }

        // Dessiner un trait
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
                // Bande orange : terrain de passage
                ctx.strokeStyle = 'rgba(234, 88, 12, 0.35)';
                ctx.lineWidth = Math.max(18, w / 22);
                ctx.setLineDash([]);
                ctx.stroke();

                // Contour du passage
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
                // Tuyau : ligne bleue
                ctx.strokeStyle = '#0369a1';
                ctx.lineWidth = Math.max(3, w / 250);
                ctx.setLineDash([]);
                ctx.stroke();
            }

            ctx.setLineDash([]);
        }

        // Dessiner un marqueur
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

        // Redessiner l'ensemble du plan
        function dessiner() {
            const w = canvas.clientWidth;
            const h = canvas.clientHeight;

            if (!w || !h) return;

            ctx.clearRect(0, 0, w, h);

            // Fond blanc
            ctx.fillStyle = '#fff';
            ctx.fillRect(0, 0, w, h);

            if (photo) {
                dessinerPhoto();
            } else {
                // Grille
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

            // Dessiner d'abord les terrains de passage
            etat.traits.filter((t) => t.passage).forEach((t) => tracerTrait(t, w, h));

            // Dessiner ensuite les tuyaux
            etat.traits.filter((t) => !t.passage).forEach((t) => tracerTrait(t, w, h));

            // Marqueur de départ
            marqueur(etat.depart, '#2563eb', labels.depart);

            // Marqueur d'arrivée
            marqueur(etat.arrivee, '#16a34a', labels.arrivee, true);
        }

        // Générer le JSON et l'image PNG

        function sauvegarder() {
            // Sauvegarder les données du dessin
            champJson.value = JSON.stringify(etat);

            const largeur = 1200;

            const largeurVisible = canvas.clientWidth;
            const hauteurVisible = canvas.clientHeight;

            if (!largeurVisible || !hauteurVisible) {
                champImage.value = '';
                return;
            }

            const hauteur = Math.round((largeur * hauteurVisible) / largeurVisible);

            const exportCanvas = document.createElement('canvas');

            exportCanvas.width = largeur;
            exportCanvas.height = hauteur;

            const exportCtx = exportCanvas.getContext('2d');

            if (!exportCtx) {
                champImage.value = '';
                return;
            }

            // Fond blanc
            exportCtx.fillStyle = '#fff';
            exportCtx.fillRect(0, 0, largeur, hauteur);

            // Exporter le canvas visible
            exportCtx.drawImage(canvas, 0, 0, canvas.width, canvas.height, 0, 0, largeur, hauteur);

            // Générer l'image PNG
            try {
                champImage.value = exportCanvas.toDataURL('image/png');
            } catch (error) {
                console.error('Erreur lors de la génération du plan :', error);
                champImage.value = '';
            }
        }

        // Obtenir la position normalisée du pointeur
        function position(e) {
            const rect = canvas.getBoundingClientRect();

            return [
                Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width)),
                Math.max(0, Math.min(1, (e.clientY - rect.top) / rect.height)),
            ];
        }

        // Changer d'outil
        function choisirOutil(nom) {
            outil = nom;

            root.querySelectorAll('[data-outil]').forEach((btn) => {
                btn.classList.toggle('is-actif', btn.dataset.outil === nom);
            });
        }

        // Début du dessin
        canvas.addEventListener('pointerdown', function (e) {
            e.preventDefault();

            canvas.setPointerCapture(e.pointerId);

            const p = position(e);

            // Positionner le départ ou l'arrivée
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

        // Déplacement du pointeur
        canvas.addEventListener('pointermove', function (e) {
            if (!traitCourant) return;

            e.preventDefault();

            traitCourant.p.push(position(e));

            dessiner();
        });

        // Fin du dessin
        function terminerDessin() {
            if (!traitCourant) return;

            traitCourant = null;

            dessiner();
            sauvegarder();
        }

        canvas.addEventListener('pointerup', terminerDessin);
        canvas.addEventListener('pointercancel', terminerDessin);
        canvas.addEventListener('lostpointercapture', terminerDessin);

        // Sélection des outils
        root.querySelectorAll('[data-outil]').forEach((btn) => {
            btn.addEventListener('click', function () {
                choisirOutil(btn.dataset.outil);
            });
        });

        // Annuler la dernière action
        const boutonAnnuler = root.querySelector('[data-action="annuler"]');

        if (boutonAnnuler) {
            boutonAnnuler.addEventListener('click', function () {
                if (!historique.length) return;

                etat = JSON.parse(historique.pop());

                dessiner();
                sauvegarder();
            });
        }

        // Effacer le dessin
        const boutonEffacer = root.querySelector('[data-action="effacer"]');

        if (boutonEffacer) {
            boutonEffacer.addEventListener('click', function () {
                if (!confirm('Effacer tout le plan ?')) return;

                copierEtat();

                etat = {
                    traits: [],
                    depart: null,
                    arrivee: null,
                };

                dessiner();
                sauvegarder();
            });
        }

        // Charger la photo du terrain
        if (inputPhoto) {
            inputPhoto.addEventListener('change', function () {
                const fichier = this.files[0];

                if (!fichier) return;

                if (!['image/jpeg', 'image/png', 'image/webp'].includes(fichier.type)) {
                    alert('Choisissez une image JPG, PNG ou WEBP.');

                    this.value = '';
                    return;
                }

                if (fichier.size > 5 * 1024 * 1024) {
                    alert('La photo ne doit pas dépasser 5 Mo.');

                    this.value = '';
                    return;
                }

                const lecteur = new FileReader();

                lecteur.onload = function (event) {
                    const nouvellePhoto = new Image();

                    nouvellePhoto.onload = function () {
                        copierEtat();

                        photo = nouvellePhoto;

                        if (nomPhoto) {
                            nomPhoto.textContent = fichier.name;
                        }

                        if (indication) {
                            indication.hidden = true;
                        }

                        dessiner();
                        sauvegarder();
                    };

                    nouvellePhoto.onerror = function () {
                        alert('Impossible de charger cette photo.');
                    };

                    nouvellePhoto.src = event.target.result;
                };

                lecteur.readAsDataURL(fichier);
            });
        }

        // Actualiser le PNG juste avant l'envoi du formulaire
        if (formulaire) {
            formulaire.addEventListener('submit', function () {
                sauvegarder();
            });
        }

        // Adapter le dessin lors du redimensionnement
        if (window.ResizeObserver) {
            new ResizeObserver(ajusterCanvas).observe(canvas);
        } else {
            window.addEventListener('resize', ajusterCanvas);
        }

        // Initialisation
        if (champJson.value) {
            dessiner();
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
