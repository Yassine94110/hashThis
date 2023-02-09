# Utilise une image PHP en tant que base
FROM php:7.4-apache

# Met à jour la liste des paquets et installe Git
RUN apt-get update && apt-get install -y git

# Copie le code source depuis GitHub
RUN git clone https://github.com/Yassine94110/hashThis.git /var/www/html/hashThis

# Définit le répertoire de travail pour les commandes suivantes
WORKDIR /var/www/html/hashThis

# Définit le propriétaire du répertoire en tant que serveur web Apache
RUN chown -R www-data:www-data /var/www/html/hashThis

# Expose le port 80 pour permettre à Apache de fonctionner
EXPOSE 80

# Démarre Apache en arrière-plan
CMD ["apachectl", "-D", "FOREGROUND"]
