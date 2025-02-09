Voici un **README.md** formaté en **Markdown** pour ton dépôt GitHub avec un **tutoriel détaillé** pour déployer ton projet Laravel sur **Hostinger**. 🚀

---

## 📜 **README.md - Association A.N.G.**

```md
# 🚀 Association A.N.G.

**Association A.N.G.** est un site vitrine construit avec **Laravel**, permettant la gestion des **articles**, **podcasts**, et autres contenus. Il inclut également un **back-office** pour l’administration des contenus.

---

## 📌 Fonctionnalités principales
- 📄 Gestion des **articles** (ajout, modification, suppression)
- 🎙️ Gestion des **podcasts** avec lecteur audio intégré
- 🛠️ Interface **admin** pour gérer les contenus
- ✉️ Formulaire de contact avec envoi d'e-mails
- 🔍 **Sitemap** automatique pour le référencement SEO
- 📝 **TinyMCE** pour l'édition des articles

---

## 🚀 Installation et mise en place en local

### 📋 **Prérequis**
- **PHP** (>= 8.0)
- **Composer** (gestionnaire de dépendances PHP)
- **Node.js et NPM** (pour la compilation des assets)
- **MySQL** (ou MariaDB) pour la base de données
- **Un serveur local** (WAMP, MAMP, Laragon ou Laravel Sail)

---

### 🛠 **Étapes d’installation**

#### 1️⃣ **Cloner le projet**
```sh
git clone https://github.com/Lokikun5/asso.git
cd asso
```

#### 2️⃣ **Installer les dépendances**
```sh
composer install
npm install
```

#### 3️⃣ **Créer et configurer le fichier `.env`**
```sh
cp .env.example .env
```
Puis, **modifie les paramètres** de la base de données et des emails dans `.env`.

#### 4️⃣ **Configurer la base de données**
Crée une base de données nommée **`assoang`** et configure `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=assoang
DB_USERNAME=root
DB_PASSWORD=
```

#### 5️⃣ **Générer la clé d’application**
```sh
php artisan key:generate
```

#### 6️⃣ **Exécuter les migrations et seeders**
```sh
php artisan migrate --seed
```

#### 7️⃣ **Compiler les assets**
```sh
npm run dev  # Mode développement
npm run prod # Mode production
```

#### 8️⃣ **Lancer le serveur local**
```sh
php artisan serve
```
Le site sera accessible sur **http://localhost:8000**.

---

## ✉️ **Configuration des emails**
Dans `.env`, configure le service SMTP pour l'envoi d'e-mails :

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=ton_mailtrap_user
MAIL_PASSWORD=ton_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=quadjovie.antonio@gmail.com
MAIL_FROM_NAME="Association A.N.G."
```
📌 **Note :** Pour un serveur réel, utilise **SendGrid, Mailgun, ou Gmail SMTP**.

---

# 🌍 **Déploiement sur Hostinger**
Si tu veux **héberger ton site Laravel sur Hostinger**, voici comment faire.  

📌 **Pourquoi Hostinger ?**
✔ **Moins cher qu’OVH** (offre **Laravel optimisée**)  
✔ **Accès SSH** ✅ (pratique pour artisan)  
✔ **Base de données + Certificat SSL gratuits**  

---

## **📌 Étapes de déploiement sur Hostinger**

### 🔹 **1️⃣ Acheter un hébergement Laravel**
1. **Va sur Hostinger** → [https://www.hostinger.fr](https://www.hostinger.fr/)
2. **Choisis "Hébergement Web Premium"** ✅ (ou Business)
3. **Achète un domaine** ou utilise le tien

---

### 🔹 **2️⃣ Uploader ton projet Laravel**
📌 **Deux méthodes :**  
🔹 **1. Via FTP (comme OVH)**  
🔹 **2. Via SSH (plus rapide, recommandé)**

**✅ Via SSH (recommandé)**
1. **Accède à SSH** dans **Hostinger > Avancé > Accès SSH**
2. **Se connecter au serveur**
   ```sh
   ssh user@ton-domaine.com
   ```
3. **Cloner le projet**
   ```sh
   git clone https://github.com/Lokikun5/asso.git .
   ```
4. **Installer Laravel**
   ```sh
   composer install --no-dev --optimize-autoloader
   npm install && npm run prod
   ```
5. **Mettre les permissions**
   ```sh
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

---

### 🔹 **3️⃣ Configurer `.env` et la base de données**
1. **Crée une base de données** sur Hostinger :
   - **Hostinger > Base de données > Créer**
   - Récupère : `DB_NAME`, `DB_USER`, `DB_PASSWORD`
2. **Modifier `.env`** :
   ```env
   APP_URL=https://ton-domaine.com
   DB_CONNECTION=mysql
   DB_HOST=mysql.hostinger.com
   DB_DATABASE=ton_db_name
   DB_USERNAME=ton_db_user
   DB_PASSWORD=ton_db_password
   ```

---

### 🔹 **4️⃣ Migration et cache**
Sur Hostinger, tu as **un accès SSH**, donc tu peux exécuter :
```sh
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

### 🔹 **5️⃣ Lier le domaine**
1. **Va sur Hostinger > Domaines**
2. **Ajoute ton domaine et lie-le au dossier Laravel**
   - **Racine web** : `/public`
3. **Ajoute un certificat SSL** gratuit

---

### 🎉 **Laravel est maintenant en ligne sur Hostinger !** 🚀

---

## 📜 **Résumé des commandes essentielles**
| **Commande** | **Description** |
|-------------|----------------|
| `php artisan migrate --seed` | Migrer la base de données avec les données de test |
| `php artisan key:generate` | Générer la clé de l'application |
| `php artisan storage:link` | Lier le stockage public |
| `npm run prod` | Compiler les assets en mode production |
| `php artisan config:cache` | Mettre en cache la configuration |
| `php artisan route:cache` | Mettre en cache les routes |
| `php artisan view:cache` | Mettre en cache les vues |

---

## 📌 OVH vs Hostinger : Quel est le meilleur ?
| Fonctionnalité     | **OVH** | **Hostinger** |
|--------------------|--------|--------------|
| **Prix** | 💰💰💰 (cher) | 💰 (moins cher) |
| **Accès SSH** | ❌ Non (sur mutualisé) | ✅ Oui |
| **Facilité d'installation** | 😕 Moyen (manipulations FTP) | 😊 Facile (SSH disponible) |
| **Stockage SSD** | ✅ Oui | ✅ Oui |
| **SSL Gratuit** | ✅ Oui | ✅ Oui |

📌 **👉 Conclusion :**  
- **OVH** est une **bonne solution**, mais un peu plus compliquée à configurer.  
- **Hostinger** est **moins cher** et **plus simple** (surtout avec SSH et Laravel intégré).  

👉 **Si tu veux un déploiement facile et rapide, Hostinger est une meilleure option.** 🚀  

---

## 📩 **Support**
Pour toute question, contacte-moi à **quadjovie.antonio@gmail.com** 📧.

```

---
