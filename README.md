# Backend Web - Laravel Project

Dit project is een Laravel-gebaseerde webapplicatie ontworpen voor het beheren van nieuws, profielen, veelgestelde vragen, berichten en gebruikersauthenticatie. Het bevat zowel openbare als admin-functionaliteiten, waarmee contentbeheer en gebruikersinteractie mogelijk zijn.

![VScode](https://img.shields.io/badge/VScode-v1.96.2-blue?style=for-the-badge&logo=visual-studio-code&logoColor=white&labelColor=000000)
![Node.js](https://img.shields.io/badge/Node.js-v20.18.1-green?style=for-the-badge&logo=node.js&logoColor=white&labelColor=000000)
![MySQL](https://img.shields.io/badge/MySQL-v8.0.40-yellow?style=for-the-badge&logo=MySQL&logoColor=white&labelColor=000000)
![Laravel](https://img.shields.io/badge/Laravel-v11.36.1-red?style=for-the-badge&logo=Laravel&logoColor=white&labelColor=000000)
![Composer](https://img.shields.io/badge/Composer-v2.7.4-brown?style=for-the-badge&logo=Composer&logoColor=white&labelColor=000000)
![PHP](https://img.shields.io/badge/PHP-v8.2.12-lightblue?style=for-the-badge&logo=PHP&logoColor=white&labelColor=000000)

## Inhoudsopgave

1. [Functionaliteiten](#functionaliteiten)
2. [Installatieproces](#installatieproces)
3. [Migratie- en Seederproces](#migratie--en-seederproces)
4. [Gebruik](#gebruik)
5. [Bronnen](#bronnen)

## Functionaliteiten

- Gebruikersauthenticatie (registratie, inloggen, uitloggen).
- Rolgebaseerde autorisatie (admin en gewone gebruikers).
- Nieuws aanmaken, bewerken en verwijderen.
- Reacties plaatsen en nieuws items liken.
- Beheer van veelgestelde vragen (FAQ).
- Contactformulier met e-mailmeldingen.
- Profielbeheer en privéberichten.

## Installatieproces

Volg de onderstaande stappen om het project op je lokale omgeving op te zetten:

1. **Kloon de repository:**

   ```bash
   git clone https://github.com/XanderWTRS/BackendWeb-Laravel.git
   ```

2. **Installeer afhankelijkheden:**

   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Stel het .env-bestand in:**
   Maak een `.env`-bestand in de rootdirectory en kopieer de inhoud van `.env.example`:

   ```bash
   cp .env.example .env
   ```

4. **Genereer de applicatiesleutel:**

   ```bash
   php artisan key:generate
   ```

5. **Stel de database in:**

   - Maak een MySQL-database lokaal aan (bijv. `backendweb_laravel`).
   - Update het `.env`-bestand met je databasegegevens:
<img width="145" alt="image" src="https://github.com/user-attachments/assets/38149292-0eab-4572-bd31-9af0d30e6246" />


6. **Configureer e-mailservice:**
   Update `.env` met je e-mailservicegegevens voor meldingen van het contactformulier:

<img width="587" alt="image" src="https://github.com/user-attachments/assets/16b3e0c5-d929-4169-9b32-747507ba64b6" />


## Migratie- en Seederproces

1. **Voer migraties uit:**

   ```bash
   php artisan migrate
   ```

2. **Seed de database:**
   Het project bevat seeders om de database te vullen met initiële gegevens.

   ```bash
   php artisan db:seed
   ```

   Of combineer migratie en seeding:

   ```bash
   php artisan migrate --seed
   ```

Je kan ook de seeders aanpassen i.v.m. hoeveel je wilt:

<img width="351" alt="image" src="https://github.com/user-attachments/assets/5a1150e7-150c-4776-9a68-efd100de6ec7" />


## Gebruik

1. **Start de ontwikkelserver:**

   ```bash
   php artisan serve
   ```

2. **Toegang tot de applicatie:**
   Open je browser en ga naar `http://127.0.0.1:8000`.

3. **Admin toegang:**

   - Standaard wordt een admin-gebruiker ge-seed in de database:
     - E-mail: `admin@ehb.be`
     - Wachtwoord: ` Password!321`

4. **Openbare toegang:**

   - Gebruikers kunnen zich registreren of inloggen om toegang te krijgen tot profiel- en nieuwsfunctionaliteiten.

## Bronnen

- [Laravel-documentatie](https://laravel.com/docs)
- [Composer-documentatie](https://getcomposer.org/doc/)
- [Node.js en NPM](https://nodejs.org/)
- [MySQL-handleiding](https://dev.mysql.com/doc/)
- [PHP](https://www.php.net/)
- Algemeene kennis? https://canvas.ehb.be/courses/40595 + https://github.com/XanderWTRS/DEF-Programming-Project-Group6

## Licentie
Dit project is beschikbaar onder de MIT-licentie.
