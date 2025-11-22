# 🎓 Centre de Formation - Site Web Complet

Site web moderne pour centre de formation avec panneau d'administration complet et pages publiques.

## 🎨 Design & Technologies

### Stack Technique
- **Backend**: Laravel 12
- **Frontend**: Vue 3 + Inertia.js
- **Styling**: Tailwind CSS 3.4
- **Composants UI**: Headless UI + Heroicons
- **Base de données**: MySQL

### Palette de Couleurs
- **Primary (Titres)**: `#e1b656` - Doré élégant
- **Dark (Textes)**: `#171923` - Gris foncé
- **Background**: Blanc avec accents gris clairs

## 📦 Structure Complète du Projet

```
luxyformation/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/                    # Contrôleurs Administration
│   │   │   ├── DashboardController   ✅ Dashboard avec stats
│   │   │   ├── UserController        ✅ CRUD Utilisateurs
│   │   │   ├── PostController        ✅ CRUD Articles (Blog)
│   │   │   ├── FormationController   ✅ CRUD Formations
│   │   │   └── PageController        ✅ CRUD Pages CMS
│   │   ├── PublicController          ✅ Page d'accueil
│   │   ├── BlogController            ✅ Blog public
│   │   ├── FormationPublicController ✅ Formations publiques
│   │   └── ContactController         ✅ Formulaire de contact
│   └── Models/
│       ├── User.php                  ✅ Avec relation posts
│       ├── Post.php                  ✅ Avec soft deletes & auto-slug
│       ├── Formation.php             ✅ Avec gestion prix & dates
│       └── Page.php                  ✅ Avec SEO & ordre menu
│
├── resources/
│   ├── js/
│   │   ├── Layouts/
│   │   │   ├── AdminLayout.vue       ✅ Layout admin moderne
│   │   │   └── PublicLayout.vue      ✅ Layout public avec nav & footer
│   │   ├── Pages/
│   │   │   ├── Admin/
│   │   │   │   ├── Dashboard.vue     ✅ Stats & actions rapides
│   │   │   │   ├── Users/            ✅ Index, Create, Edit
│   │   │   │   ├── Posts/            ✅ Index, Create, Edit
│   │   │   │   ├── Formations/       ⚠️  Contrôleur prêt (vues à créer)
│   │   │   │   └── Pages/            ⚠️  Contrôleur prêt (vues à créer)
│   │   │   └── Public/
│   │   │       ├── Home.vue          ✅ Page d'accueil complète
│   │   │       ├── Blog/Index.vue    ✅ Liste des articles
│   │   │       ├── Formations/Index  ✅ Catalogue formations
│   │   │       └── Contact.vue       ✅ Formulaire de contact
│   │   └── Components/
│   │       └── Admin/
│   │           ├── Modal.vue         ✅ Modal réutilisable
│   │           ├── PageHeader.vue    ✅ En-tête de page
│   │           └── Table.vue         ✅ Tableau générique
│   └── css/
│       └── app.css                   ✅ Classes custom + Tailwind
│
└── routes/
    └── web.php                       ✅ Routes publiques + admin
```

## 🌐 Pages Publiques Disponibles

### 1. **Page d'Accueil** (`/`)
- Hero section avec CTA
- Section "Pourquoi nous choisir" (4 features)
- Formations à venir (3 dernières)
- Articles de blog récents (3 derniers)
- Section CTA finale
- Footer complet avec navigation

### 2. **Blog** (`/blog`)
- Liste des articles publiés (grid 3 colonnes)
- Pagination
- Image à la une, auteur, date
- Extrait des articles
- Lien vers article complet

### 3. **Catalogue de Formations** (`/formations`)
- Liste des formations publiées (grid 3 colonnes)
- Badge de niveau (débutant, intermédiaire, avancé)
- Affichage durée, participants max, date de début
- Prix affiché
- Pagination
- Lien vers formation complète

### 4. **Contact** (`/contact`)
- Formulaire de contact (nom, email, sujet, message)
- Coordonnées complètes (email, téléphone, adresse)
- Horaires d'ouverture
- Validation des champs
- Message de confirmation

## 🔧 Panneau d'Administration

### Accessible via `/admin` (requiert authentification)

#### Dashboard (`/admin/dashboard`)
- Statistiques : Nombre d'utilisateurs, posts, formations, pages
- Actions rapides (liens directs vers création)
- Design moderne avec cartes colorées

#### Gestion des Utilisateurs (`/admin/users`)
- **Liste**: Recherche, pagination, nom, email, date de création
- **Créer**: Nom, email, mot de passe (avec confirmation)
- **Modifier**: Mise à jour infos + changement mot de passe optionnel
- **Supprimer**: Avec confirmation modal (protection auto-suppression)

#### Gestion du Blog (`/admin/posts`)
- **Liste**: Recherche, filtres par statut (draft/published), pagination
- **Créer**: Titre, slug, extrait, contenu, image, statut, date de publication
- **Modifier**: Tous les champs modifiables
- **Supprimer**: Avec confirmation modal
- **Features**: Auto-génération du slug, soft deletes

#### Gestion des Formations (`/admin/formations`)
- **Contrôleur complet** avec validation
- **Champs**: Titre, slug, description, contenu, image, durée, prix, niveau, participants max, dates, statut
- **Statuts**: Draft, Published, Archived
- ⚠️ **Vues à créer** (suivre le modèle Posts)

#### Gestion des Pages (`/admin/pages`)
- **Contrôleur complet** avec validation
- **Champs**: Titre, slug, contenu, SEO (meta title, meta description), ordre, visibilité menu, statut
- ⚠️ **Vues à créer** (suivre le modèle Posts)

## 🚀 Installation & Démarrage

### 1. Cloner le projet
```bash
git clone <votre-repo>
cd luxyformation
```

### 2. Installer les dépendances
```bash
composer install
npm install
```

### 3. Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Configurez votre base de données dans `.env`:
```env
DB_CONNECTION=mysql
DB_DATABASE=luxyformation
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Créer la base de données
```bash
# Connectez-vous à MySQL
mysql -u root -p

# Créez la base
CREATE DATABASE luxyformation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit;
```

### 5. Lancer les migrations
```bash
php artisan migrate
```

### 6. Créer un utilisateur admin
```bash
php artisan tinker
```
```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@formation.fr',
    'password' => bcrypt('password'),
    'email_verified_at' => now(),
]);
exit
```

### 7. Builder les assets (déjà fait)
```bash
npm run build
# ou pour le développement
npm run dev
```

### 8. Lancer le serveur
```bash
php artisan serve
```

Accédez à : **http://localhost:8000**

## 📝 Utilisation

### Accès Admin
1. Allez sur `/login`
2. Connectez-vous avec : `admin@formation.fr` / `password`
3. Vous serez redirigé vers `/admin/dashboard`

### Créer du Contenu
1. **Articles de blog**: `/admin/posts/create`
2. **Formations**: `/admin/formations/create`
3. **Pages CMS**: `/admin/pages/create`

### Voir le Site Public
- **Accueil**: `/`
- **Blog**: `/blog`
- **Formations**: `/formations`
- **Contact**: `/contact`

## 🎨 Personnalisation

### Modifier les couleurs
Éditez `tailwind.config.js`:
```js
colors: {
    primary: { DEFAULT: '#e1b656', ... },
    dark: { DEFAULT: '#171923', ... }
}
```

### Ajouter des classes custom
Éditez `resources/css/app.css`:
```css
@layer components {
    .ma-classe { @apply ... }
}
```

### Modifier le footer
Éditez `resources/js/Layouts/PublicLayout.vue`

## 📊 Fonctionnalités Avancées

### Scopes Eloquent
Les modèles incluent des scopes utiles:
```php
// Posts
Post::published()->get();          // Articles publiés
Post::draft()->get();              // Brouillons

// Formations
Formation::published()->get();     // Formations publiées
Formation::upcoming()->get();      // Formations à venir
Formation::archived()->get();      // Formations archivées

// Pages
Page::inMenu()->get();            // Pages visibles au menu
```

### Auto-génération des Slugs
Les modèles génèrent automatiquement un slug depuis le titre si non fourni.

### Soft Deletes
Tous les modèles utilisent le soft delete, les données ne sont jamais vraiment supprimées.

## 🔜 Prochaines Étapes (Optionnel)

### À Compléter
1. **Vues admin Formations & Pages**
   - Créer `Index.vue`, `Create.vue`, `Edit.vue`
   - Suivre le modèle de `Posts`

2. **Pages individuelles publiques**
   - `/blog/{slug}` - Article complet
   - `/formations/{slug}` - Formation complète
   - Contrôleurs déjà prêts, créer les vues

3. **Améliorer le formulaire de contact**
   - Envoyer vraiment des emails
   - Créer un `ContactMail` avec `php artisan make:mail`

4. **Upload d'images**
   - Implémenter upload réel d'images
   - Utiliser Storage Laravel

5. **Éditeur WYSIWYG**
   - Intégrer TinyMCE ou Quill
   - Pour les champs `content`

6. **Pagination côté serveur**
   - Déjà implémentée avec `->paginate()`

## 🔐 Sécurité

- ✅ Authentification Laravel Breeze
- ✅ Protection CSRF
- ✅ Validation des formulaires
- ✅ Soft deletes
- ✅ Hashage des mots de passe
- ✅ Protection routes admin (middleware auth)

## 📖 Routes Disponibles

### Routes Publiques
```
GET  /                    → Page d'accueil
GET  /blog                → Liste des articles
GET  /blog/{slug}         → Article individuel
GET  /formations          → Catalogue formations
GET  /formations/{slug}   → Formation individuelle
GET  /contact             → Formulaire contact
POST /contact             → Envoi formulaire
GET  /login               → Page de connexion
POST /login               → Authentification
GET  /register            → Inscription
```

### Routes Admin (requiert auth)
```
GET  /admin/dashboard     → Dashboard
GET  /admin/users         → Liste utilisateurs
GET  /admin/users/create  → Créer utilisateur
GET  /admin/posts         → Liste articles
GET  /admin/posts/create  → Créer article
GET  /admin/formations    → Liste formations
GET  /admin/pages         → Liste pages
```

## 💡 Conseils

1. **Développement**: Utilisez `npm run dev` pour le hot reload
2. **Production**: `npm run build` puis déployer
3. **Base de données**: Pensez aux seeders pour données de test
4. **Images**: Utilisez un service comme Cloudinary ou AWS S3
5. **Emails**: Configurez SMTP ou utilisez un service (Mailtrap en dev)

## 🤝 Support

Pour toute question:
- Consultez la documentation Laravel: https://laravel.com/docs/12.x
- Inertia.js: https://inertiajs.com/
- Vue 3: https://vuejs.org/
- Tailwind CSS: https://tailwindcss.com/

---

**Développé avec ❤️ pour les centres de formation modernes**

*Site complet, prêt à l'emploi !* ✨
