# **Association A.N.G.**

📢 **Association A.N.G.** est un site vitrine construit avec **Laravel**, permettant la gestion des **articles**, **podcasts**, et autres contenus. Il inclut également un **back-office** pour l’administration des contenus.

---

## **📌 Fonctionnalités principales**
- Site vitrine pour l'**Association A.N.G.**
- Gestion des **articles** (ajout, modification, suppression)
- Gestion des **podcasts** avec lecteur audio intégré
- Interface **admin** pour gérer les contenus
- Formulaire de contact avec envoi d'e-mails
- **Sitemap** automatique pour le référencement SEO
- **TinyMCE** pour l'édition des articles

---

## **🚀 Installation et mise en place en local**

### **📋 Prérequis**
- **PHP** (>= 8.0)
- **Composer** (gestionnaire de dépendances PHP)
- **Node.js et NPM** (pour la compilation des assets)
- **MySQL** (ou MariaDB) pour la base de données
- **Un serveur local** (WAMP, MAMP, Laragon ou Laravel Sail)

---

### **🛠 Étapes d’installation**

1️⃣ **Cloner le projet**
```sh
git clone https://github.com/ton-utilisateur/association-ang.git
cd association-ang

2️⃣ Installer les dépendances

composer install
npm install

3️⃣ Créer et configurer le fichier .env
Copie du fichier d'exemple :

cp .env.example .env

Puis modifie les paramètres de la base de données et des emails dans .env.

4️⃣ Configurer la base de données
Crée une base de données nommée assoang et configure .env :

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=assoang
DB_USERNAME=root
DB_PASSWORD=

5️⃣ Générer la clé d’application

php artisan key:generate

6️⃣ Exécuter les migrations et seeders

php artisan migrate --seed

7️⃣ Compiler les assets

npm run dev  # Mode développement
npm run prod # Mode production

8️⃣ Lancer le serveur local

php artisan serve

Le site sera accessible sur http://localhost:8000.
✉️ Configuration des emails

Dans .env, configure le service SMTP pour l'envoi d'e-mails :

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=d042de28bcedb6
MAIL_PASSWORD=16db1976bac66d
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=quadjovie.antonio@gmail.com
MAIL_FROM_NAME="Association A.N.G."

🔹 MailTrap est utilisé pour tester les emails en local.
🔹 Pour un serveur réel, utilise SendGrid, Mailgun ou Gmail SMTP.
🔗 Mise en ligne du site

Si tu ne fais pas la mise en ligne toi-même, voici les étapes pour la personne en charge.
🌍 1️⃣ Choisir un hébergeur

    Option 1 : Hébergement mutualisé (OVH, Infomaniak, LWS, PlanetHoster)
    Option 2 : VPS / Serveur cloud (DigitalOcean, AWS, Linode)
    Option 3 : Laravel Forge (déploiement automatisé)

🔥 2️⃣ Déployer le projet
a) Envoyer les fichiers sur le serveur

Via FTP (FileZilla) ou en SSH :

scp -r association-ang user@yourserver:/var/www/html/

Ou avec Git + SSH :

git clone https://github.com/ton-utilisateur/association-ang.git

b) Installer les dépendances

composer install --no-dev --optimize-autoloader
npm install && npm run prod

c) Configurer le serveur

    Vérifier que le DocumentRoot pointe sur /public.
    Activer mod_rewrite pour Apache :

a2enmod rewrite
service apache2 restart

    Mettre à jour les permissions :

chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

d) Configurer l’environnement

php artisan key:generate
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

e) Mettre en place un Cron Job

Ajoute ceci dans crontab -e pour exécuter les tâches Laravel :

* * * * * php /var/www/html/artisan schedule:run >> /dev/null 2>&1

f) Redémarrer le serveur

systemctl restart apache2  # Pour Apache
systemctl restart nginx    # Pour Nginx

⚡ Utilisation

Accès au site :

    Frontend (public) → http://localhost:8000
    Back-Office (Admin) → http://localhost:8000/admin

Compte administrateur (par défaut) :

Email: admin@example.com
Mot de passe: password

⚠️ Changez le mot de passe après l’installation !
📜 Technologies utilisées

    Laravel - Framework PHP
    MySQL - Base de données
    Bootstrap - Interface responsive
    TinyMCE - Éditeur de texte
    Lightbox2 - Galerie d’images
    FontAwesome - Icônes

📌 Améliorations futures

    🔹 Ajout d’une API pour les podcasts
    🔹 Optimisation SEO avancée
    🔹 Ajout d’une recherche avancée
    🔹 Gestion des utilisateurs avec rôles

📩 Support

Pour toute question, contacte-moi à quadjovie.antonio@gmail.com.