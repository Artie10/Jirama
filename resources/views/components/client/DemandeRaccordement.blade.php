{{-- resources/views/components/demande-raccordement.blade.php --}}
@props([
    'action' => route('TraitementDossierA'),
    'nom' => old('nom', 'RAKOTO'),
    'prenom' => old('prenom', 'Jean Michel'),
    'cin' => old('cin', '101245789630'),
    'telephone' => old('telephone', '+261 34 12 345 67'),
    'email' => old('email', 'jean.rakoto@example.com'),
])

<link rel="stylesheet" href="{{ asset('css/demande-raccordement.css') }}">

<div class="vr-page">
    <header class="vr-header">
        <a class="vr-brand" href="{{ url('/') }}" aria-label="Accueil VoltaRéseau">
            <span class="vr-brand-mark">V</span>
            <span>VoltaRéseau</span>
        </a>

        <nav class="vr-public-nav" aria-label="Navigation principale">
            <a href="#">Démarches &amp; Barèmes</a>
            <a href="#">Simulateur de devis</a>
            <a href="#">Installateurs agréés</a>
            <a href="#">Documentation</a>
        </nav>

        <div class="vr-user">
            <span class="vr-avatar">ML</span>
            <span><strong>Mon espace</strong><small>Demandeur</small></span>
        </div>
    </header>

    <section class="vr-hero">
        <div class="vr-hero-inner">
            <div class="vr-hero-heading">
                <div>
                    <span class="vr-eyebrow"><span class="vr-live-dot"></span> Dossier d'accès réseau BT · 230/400V</span>
                    <h1>Nouvelle demande de raccordement électrique</h1>
                    <p>Renseignez les informations du demandeur et joignez les pièces justificatives nécessaires à l’étude de votre demande.</p>
                </div>
                <div class="vr-compliance">
                    <span class="vr-compliance-icon">✓</span>
                    <span><strong>Conformité réglementaire</strong><small>Les pièces transmises seront examinées par le service compétent.</small></span>
                </div>
            </div>

            <div class="vr-steps" aria-label="Étapes du formulaire">
                <div class="vr-step vr-step-active">
                    <span class="vr-step-number">1</span>
                    <span><small>Étape active</small><strong>Identité et pièces</strong></span>
                    <span class="vr-step-symbol">✎</span>
                </div>
                <div class="vr-step">
                    <span class="vr-step-number">2</span>
                    <span><small>Étape suivante</small><strong>Localisation du branchement</strong></span>
                </div>
                <div class="vr-step">
                    <span class="vr-step-number">3</span>
                    <span><small>Dernière étape</small><strong>Récapitulatif et soumission</strong></span>
                </div>
            </div>
        </div>
    </section>

    <div class="vr-demo-notice"><strong>Mode conception — données fictives</strong><span>Les informations affichées servent uniquement à prévisualiser l’interface. Les documents sont des exemples, pas des fichiers réellement téléversés.</span></div>

    <div class="vr-workspace">
        <form class="vr-form" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf

            <section class="vr-card">
                <div class="vr-section-heading">
                    <span class="vr-section-icon">01</span>
                    <div>
                        <h2>Identité civile et coordonnées</h2>
                        <p>Tous les champs marqués d’un astérisque (*) sont obligatoires.</p>
                    </div>
                </div>

                <fieldset class="vr-fieldset">
                    <legend>Statut juridique du demandeur <em>*</em></legend>
                    <div class="vr-choice-grid">
                        <label class="vr-choice">
                            <input type="radio" name="statut_demandeur" value="proprietaire"
                                {{ old('statut_demandeur', 'proprietaire') === 'proprietaire' ? 'checked' : '' }} required>
                            <span><strong>Propriétaire occupant / titulaire foncier</strong><small>Titulaire du droit d’occupation et futur abonné.</small></span>
                        </label>
                        <label class="vr-choice">
                            <input type="radio" name="statut_demandeur" value="mandataire"
                                {{ old('statut_demandeur') === 'mandataire' ? 'checked' : '' }}>
                            <span><strong>Mandataire / locataire avec accord</strong><small>Agit avec une procuration ou un accord écrit.</small></span>
                        </label>
                    </div>
                    @error('statut_demandeur') <p class="vr-error">{{ $message }}</p> @enderror
                </fieldset>

                <div class="vr-fields-two">
                    <div class="vr-field">
                        <label for="nom">Nom de famille <em>*</em></label>
                        <input id="nom" name="nom" type="text" value="{{ $nom }}" placeholder="Ex. : RAKOTONDRAZAFY" autocomplete="family-name" required>
                        <small>Identique à la pièce officielle d’identité.</small>
                        @error('nom') <p class="vr-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="vr-field">
                        <label for="prenom">Prénom(s) <em>*</em></label>
                        <input id="prenom" name="prenom" type="text" value="{{ $prenom }}" placeholder="Ex. : Jean-Marc" autocomplete="given-name" required>
                        <small>Tel qu’indiqué sur votre pièce d’identité.</small>
                        @error('prenom') <p class="vr-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="vr-cin-panel">
                    <div class="vr-cin-title">
                        <label for="cin">Numéro de Carte d’Identité Nationale (CIN) <em>*</em></label>
                        <span>12 chiffres requis</span>
                    </div>
                    <input id="cin" name="cin" type="text" inputmode="numeric" maxlength="12"
                           pattern="[0-9]{12}" value="{{ preg_replace('/\D/', '', $cin) }}"
                           placeholder="101245789630" aria-describedby="cin-help cin-counter" required>
                    <div class="vr-cin-foot">
                        <small id="cin-help">Saisissez les 12 chiffres sans espace.</small>
                        <small id="cin-counter">0 / 12 chiffres</small>
                    </div>
                    @error('cin') <p class="vr-error">{{ $message }}</p> @enderror
                </div>

                <div class="vr-fields-two">
                    <div class="vr-field">
                        <label for="telephone">Téléphone mobile <em>*</em></label>
                        <input id="telephone" name="telephone" type="tel" value="{{ $telephone }}" placeholder="+261 34 00 000 00" autocomplete="tel" required>
                        <small>Pour être contacté avant le passage du technicien.</small>
                        @error('telephone') <p class="vr-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="vr-field">
                        <label for="email">Adresse e-mail <em>*</em></label>
                        <input id="email" name="email" type="email" value="{{ $email }}" placeholder="nom@domaine.com" autocomplete="email" required>
                        <small>Pour recevoir le devis et les avis relatifs au dossier.</small>
                        @error('email') <p class="vr-error">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="vr-fields-two">
    <div class="vr-field">
        <label for="password">Mot de passe <em>*</em></label>
        <input
            id="password"
            name="password"
            type="password"
            minlength="8"
            autocomplete="new-password"
            placeholder="8 caractères minimum"
            required
        >
        @error('password')
            <p class="vr-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="vr-field">
        <label for="password_confirmation">
            Confirmer le mot de passe <em>*</em>
        </label>
        <input
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            minlength="8"
            autocomplete="new-password"
            placeholder="Répétez votre mot de passe"
            required
        >
    </div>
</div>
            </section>

            <section class="vr-card">
                <div class="vr-section-heading vr-section-heading-between">
                    <div class="vr-heading-main">
                        <span class="vr-section-icon vr-section-icon-blue">02</span>
                        <div>
                            <h2>Pièces justificatives obligatoires</h2>
                            <p>Formats admis selon les règles de validation du serveur. Vérifiez que chaque document est lisible.</p>
                        </div>
                    </div>
                    <span class="vr-count-badge">Documents à joindre</span>
                </div>

                <div class="vr-doc-grid">
                    <div class="vr-doc-card">
                        <div class="vr-doc-heading">
                            <span class="vr-doc-icon">ID</span>
                            <div><h3>Photo d’identité</h3><p>Portrait récent, fond neutre et visage dégagé.</p></div>
                        </div>
                        <div class="vr-mock-file">
                            <span class="vr-mock-file-icon">JPG</span>
                            <span><strong>photo_identite_demo.jpg</strong><small>1,2 Mo · Aperçu fictif</small></span>
                            <span class="vr-mock-status">Exemple</span>
                        </div>
                        <label class="vr-upload" for="photo_identite">
                            <span class="vr-upload-symbol">＋</span><strong>Remplacer la photo</strong><small>JPG, JPEG ou PNG</small>
                            <input id="photo_identite" name="photo_identite" type="file" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                        </label>
                        @error('photo_identite') <p class="vr-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="vr-doc-card">
                        <div class="vr-doc-heading">
                            <span class="vr-doc-icon">PDF</span>
                            <div><h3>Justificatif de domicile</h3><p>Certificat de résidence, titre foncier ou document admis.</p></div>
                        </div>
                        <div class="vr-mock-file">
                            <span class="vr-mock-file-icon vr-mock-pdf">PDF</span>
                            <span><strong>certificat_residence_demo.pdf</strong><small>850 Ko · Aperçu fictif</small></span>
                            <span class="vr-mock-status">Exemple</span>
                        </div>
                        <label class="vr-upload" for="justificatif_domicile">
                            <span class="vr-upload-symbol">＋</span><strong>Remplacer le document</strong><small>PDF ou image</small>
                            <input id="justificatif_domicile" name="justificatif_domicile" type="file" accept=".pdf,.jpg,.jpeg,.png,.webp">
                        </label>
                        @error('justificatif_domicile') <p class="vr-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="vr-doc-card">
                        <div class="vr-doc-heading">
                            <span class="vr-doc-icon vr-doc-icon-gold">CIN</span>
                            <div><h3>Copie de la CIN (recto/verso) <em>*</em></h3><p>Carte lisible, angles visibles et sans reflet.</p></div>
                        </div>
                        <label class="vr-upload" for="cin_document">
                            <span class="vr-upload-symbol">＋</span><strong>Importer la copie de la CIN</strong><small>PDF, JPG ou PNG</small>
                            <input id="cin_document" name="cin_document" type="file" accept=".pdf,.jpg,.jpeg,.png" required>
                        </label>
                        @error('cin_document') <p class="vr-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="vr-doc-card">
                        <div class="vr-doc-heading">
                            <span class="vr-doc-icon vr-doc-icon-gold">✎</span>
                            <div><h3>Demande manuscrite signée <em>*</em></h3><p>Lettre datée et signée sollicitant le raccordement.</p></div>
                        </div>
                        <label class="vr-upload" for="demande_signee">
                            <span class="vr-upload-symbol">＋</span><strong>Importer la demande signée</strong><small>PDF ou photo lisible</small>
                            <input id="demande_signee" name="demande_signee" type="file" accept=".pdf,.jpg,.jpeg,.png" required>
                        </label>
                        @error('demande_signee') <p class="vr-error">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>

            <section class="vr-legal-card">
                <div class="vr-legal-icon">⚙</div>
                <div class="vr-legal-content">
                    <h2>Intervention du technicien sur site</h2>
                    <p>Après validation du dossier, un technicien pourra intervenir à l’adresse indiquée dans l’étape suivante pour examiner les conditions techniques du raccordement et préparer le devis.</p>
                </div>
                <label class="vr-certification">
                    <input id="certification" name="certification" type="checkbox" value="1" required {{ old('certification') ? 'checked' : '' }}>
                    <span><strong>Déclaration sur l’honneur <em>*</em></strong><small>Je certifie l’exactitude des informations et l’authenticité des documents fournis. J’autorise l’accès à la propriété pour les opérations techniques nécessaires.</small></span>
                </label>
                @error('certification') <p class="vr-error vr-error-light">{{ $message }}</p> @enderror
            </section>

            <div class="vr-actions">
                <button class="vr-btn vr-btn-secondary" type="reset">Réinitialiser le formulaire</button>
                <button class="vr-btn vr-btn-primary" type="submit">Valider et continuer <span aria-hidden="true">→</span></button>
            </div>
        </form>

        <aside class="vr-sidebar">
            <section class="vr-card vr-checklist">
                <h2><span class="vr-aside-icon">✓</span> Contrôle de recevabilité</h2>
                <p>Avant l’envoi, vérifiez que les informations sont exactes et que les fichiers sont lisibles.</p>
                <ul>
                    <li><span>✓</span> CIN comportant 12 chiffres</li>
                    <li><span>✓</span> Photo d’identité nette</li>
                    <li><span>✓</span> Justificatif de domicile</li>
                    <li><span>•</span> Demande manuscrite signée</li>
                </ul>
            </section>

            <section class="vr-help-card">
                <h2><span class="vr-aside-icon">↔</span> Préparer la visite technique</h2>
                <p>Assurez-vous que le technicien pourra accéder à la limite de votre propriété et à l’emplacement prévu pour le raccordement.</p>
                <div class="vr-help-meta"><span>Suivi de la demande</span><strong>Depuis votre espace client</strong></div>
            </section>

            <section class="vr-support">
                <span class="vr-support-icon">?</span>
                <div><small>Besoin d’aide ?</small><strong>Contactez le service client</strong><p>Utilisez les coordonnées officielles de votre agence.</p></div>
            </section>
        </aside>
    </div>

    <footer class="vr-footer">
        <strong>VoltaRéseau</strong>
        <span>Portail de demande de raccordement électrique</span>
        <span>© {{ date('Y') }} · Tous droits réservés</span>
    </footer>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cin = document.getElementById('cin');
    const counter = document.getElementById('cin-counter');

    if (cin && counter) {
        const updateCounter = function () {
            cin.value = cin.value.replace(/\D/g, '').slice(0, 12);
            counter.textContent = cin.value.length + ' / 12 chiffres';
            counter.classList.toggle('is-complete', cin.value.length === 12);
        };
        cin.addEventListener('input', updateCounter);
        updateCounter();
    }

    document.querySelectorAll('.vr-upload input[type="file"]').forEach(function (input) {
        input.addEventListener('change', function () {
            const label = input.closest('.vr-upload');
            const strong = label.querySelector('strong');
            if (input.files && input.files.length) {
                strong.textContent = input.files[0].name;
                label.classList.add('has-file');
            } else {
                label.classList.remove('has-file');
            }
        });
    });
});
</script>
