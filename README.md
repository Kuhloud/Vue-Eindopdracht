# Vue-Eindopdracht

// Instructies PHP-Backend
in Vue-Eindopdracht, in terminal, cd ./PHP-Backend/ (gebruik tab)
Open Docker
in vsc, druk op new terminal, en typ docker compose up.
in de url, typ localhost

// Instructies Vue-Frontend
in Vue-Eindopdracht, in terminal, cd ./PHP-Backend/ (gebruik tab)
in vsc, druk op new terminal, en typ npm run dev.
in de url, typ localhost:5173

Gebruikers
// Member
Username: TestMan1
Email: Test_Man@hotmail.com
Password: TestPassword

Username: Normal User
Email: normal@hotmail.com
Password: normal

Username: test
Email: test@gmail.com
Password: test

// Moderators
Username: mawd
Email: mod@gmail.com
Password: mod

// Administrators
Username: ad
Email: admin@gmail.com
Password: admin


    1. Required functionality: Je kan boards bekijken, threads bekijken, threads maken in een board, waarbij je tags kan toevoegen, posts maken in een board, en ze editen. Voor Moderators en Admins kunnen zij threads, en posts verwijderen.

    2. CSS: Ik heb grotendeels bootstrap, en mijn eigen css gebruikt, die in Vue-Frontend\src\assets\css\style.css zit. Ik heb grotendeels het ontwerp van mijn web dev 1 opdracht gebruikt.

    3. Frontend architecture: Routing is geïmplementeerd in deze website. State: Vue-Frontend\src\stores Router: Vue-Frontend\src\router\index.js

    4. REST API: Applicatie filtert automatisch van het maken van een account, en het inloggen. Verder bij posts zou het de bedoeling zijn dat 'Moderators' en 'Administrators' ze verwijderen. Ook zijn de repositories zo gemaakt om SQL injections te voorkomen

    5. Authentication: Geef aan of je Role Based Access Control hebt geïmplementeerd, verwijs naar de specifieke code waar dit aan kan worden gezien. Role Based Access Control is geïmplementeerd in PHP-Backend\app\public\index.php. Er is ook een .env met de JWT_GENERATED_KEY




 
