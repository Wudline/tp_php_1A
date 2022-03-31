create database croissant;
create table etudiant(
    id serial primary key,
    login varchar(50) not null unique,  
    -- check(login, '[A-Za-z]{1,10}.[A-Za-z]{1,10}[0-9]?'),
    nom varchar(50) not null,
    -- check(nom, '[A-Za-z]+ [A-Za-z -]+'),
    mdp varchar(50) not null, 
    classe int, 
    promo int,
    role int
);

create table classe(
    id serial primary key,
    nom varchar(50) not null unique
);

create table promo(
    id serial primary key,
    annee varchar(4) not null unique 
    -- check(annee, '(19||20)[0-9]{2}')
);

create table role(
    id serial primary key,
    nom varchar(50) not null unique
);

create table viennoiserie(
    id serial primary key,
    nom varchar(50) not null unique
);

create table croissantage(
    id serial primary key,
    croissanteur int references etudiant.id, 
    croissante int references etudiant.id, 
    dateCroissantage date not null,
    deadline date not null, 

    unique (croissanteur, croissante, dateCroissantage)
);


create table commande(
    id serial primary key,
    croissantage int references croissantage.id, 
    dateCommande date not null
);

create table demande(
    id serial primary key,
    croissantage int references croissantage.id,
    etudiant int references etudiant.id,  
    viennoiserie int references viennoiserie.id
);

-- insertion de valeurs

insert into classe (nom) values
("admin"),
("etudiant");

insert into classe (nom) values 
("IMR"),
("IPS");

insert into promo (annee) values 
("2019"),
("2020"),
("2021"),
("2022");

insert into viennoiserie (nom) values
("Croissant"),
("Pain au chocolat");

insert into etudiant (login, nom, mdp, classe, promo, role) values
("lu.dmon", "Luffy MONKEY D.", "gomugomunomi", 1, 1, 2),
("zo.ro", "Zoro RORONOA", "AsuraSlash", 1, 1, 2),
("na.mi", "Nami CATBURGLAR", "Berry", 1, 1, 2),
("san.vin", "Sanji VINSMOKE", "DiableJambe", 1, 1, 2),
("cho.ton", "Chopper TONY TONY", "RumbleBall", 1, 1, 2),
("uso.god", "Usopp SOGEKING", "MidoriBoshi", 2, 1, 2),
("rob.ni", "Robin NICO", "HanaFleur", 2, 1, 2),
("fra.ky", "Franky", "SUPERRR", 2, 1, 2),
("bro.ok", "Brook", "YohohoPantsu!", 2, 1, 2),
("jin.kos", "Jinbei KINGOFSEA", "Helmsman", 2, 1, 2),

("bul.biz", "Bull BIZARRE", "Bullbi", 1, 2, 2),
("sal.ame", "Sal AMECHE", "Sala", 1, 2, 2),
("car.apu", "Cara PUCE", "Cara", 1, 2, 2),
("pik.chu", "Pika CHU", "Pika", 1, 2, 2),
("mel.ofe", "Mel OFEE", "Melo", 1, 2, 2),
("gou.pix", "Gou PIX", "Gou", 2, 2, 2),
("nos.fer", "Nos FERAPTI", "NosNos", 2, 2, 2),
("arc.can", "Arca NIN", "bwouf", 2, 2, 2),
("fan.tom", "Fanto MINUS", "boo", 2, 2, 2),
("oss.lai", "Osse LAIT", "nonos", 2, 2, 2),

("nar.uzu", "Naruto UZUMAKI", "ramen", 1, 3, 2),
("sak.har", "Sakura HARUNO", "sasuke", 1, 3, 2),
("sas.uch", "Sasuke UCHIWA", "vengence", 1, 3, 2),
("hin.hyu", "Hinata HYUGA", "naruto", 1, 3, 2),
("kib.inu", "Kiba INUZUKA", "akimaru", 1, 3, 2),
("shi.abu", "Shino ABURAME", "insect", 2, 3, 2),
("gaa.dud", "Gaara DUDESERT", "amour", 2, 3, 2),
("tem.dud", "Temari DUDESERT", "eventail", 2, 3, 2),
("kan.dud", "Kankuro DUDESERT", "marionnette", 2, 3, 2),
("ita.uch", "Itachi UCHIWA", "konoha", 2, 3, 2),

("lu.cifer", "Lu CIFER", "Azerty", 1, 4, 1),
("ad.min", "Adelle MINI", "admin", 1, 4, 1),
("nyu.bee", "Nyu BEE", "noob", 2, 4, 2);


insert into croissantage (croissanteur, croissante, dateCroissantage, deadline) values 
(1, 2, "2019-01-01", "2019-01-07"),
(1, 3, "2019-02-01", "2019-02-07"),
(1, 4, "2019-03-01", "2019-03-07"),
(1, 5, "2019-04-01", "2019-04-07"),
(1, 6, "2019-05-01", "2019-05-07"),
(1, 6, "2019-06-01", "2019-06-07"),
(1, 7, "2019-07-01", "2019-07-07"),
(1, 2, "2019-08-01", "2019-08-07"),
(1, 2, "2019-09-01", "2019-09-07"),

(11, 12, "2020-01-01", "2020-01-07"),
(11, 13, "2020-02-01", "2020-02-07"),
(11, 14, "2020-03-01", "2020-03-07"),
(11, 15, "2020-04-01", "2020-04-07"),
(11, 16, "2020-05-01", "2020-05-07"),
(11, 16, "2020-06-01", "2020-06-07"),
(11, 17, "2020-07-01", "2020-07-07"),
(11, 12, "2020-08-01", "2020-08-07"),
(11, 12, "2020-09-01", "2020-09-07"),
(11, 12, "2020-10-01", "2020-10-07"),
(11, 12, "2020-11-01", "2020-11-07"),
(11, 12, "2020-12-01", "2020-12-07"),

(21, 22, "2021-01-01", "2021-01-07"),
(21, 22, "2021-01-10", "2021-01-17"),
(21, 23, "2021-02-01", "2021-02-07"),
(21, 23, "2021-02-10", "2021-02-17"),
(21, 24, "2021-03-01", "2021-03-07"),
(21, 24, "2021-03-10", "2021-03-17"),
(21, 25, "2021-04-01", "2021-04-07"),
(21, 25, "2021-04-10", "2021-04-17"),
(21, 26, "2021-05-01", "2021-05-07"),
(21, 26, "2021-05-10", "2021-05-17"),
(21, 26, "2021-06-01", "2021-06-07"),
(21, 26, "2021-06-10", "2021-06-17"),
(21, 27, "2021-07-01", "2021-07-07"),
(21, 27, "2021-07-10", "2021-07-17"),
(21, 22, "2021-08-01", "2021-08-07"),
(21, 22, "2021-08-10", "2021-08-17"),
(21, 29, "2021-09-01", "2021-09-07"),
(21, 29, "2021-09-10", "2021-09-17"),
(21, 29, "2021-10-01", "2021-10-07"),
(21, 22, "2021-10-10", "2021-10-17"),
(21, 22, "2021-11-01", "2021-11-07"),
(21, 22, "2021-11-10", "2021-11-17"),
(21, 22, "2021-12-01", "2021-12-07"),
(21, 22, "2021-12-10", "2021-12-17");

insert into demande (croissantage, etudiant, viennoiserie) values
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 5, 1),
(1, 6, 1),
(1, 7, 1),
(1, 8, 1),
(1, 9, 1),
(1, 10, 1),
(2, 1, 1),
(2, 2, 1),
(2, 3, 1),
(2, 4, 1),
(2, 5, 1),
(2, 6, 1),
(2, 7, 1),
(2, 8, 1),
(2, 9, 1),
(2, 10, 1),
(3, 1, 1),
(3, 2, 1),
(3, 3, 1),
(3, 4, 1),
(3, 5, 1),
(3, 6, 1),
(3, 7, 1),
(3, 8, 1),
(3, 9, 1),
(3, 10, 1),
(4, 1, 1),
(4, 2, 1),
(4, 3, 1),
(4, 4, 1),
(4, 5, 1),
(4, 6, 1),
(4, 7, 1),
(4, 8, 1),
(4, 9, 1),
(4, 10, 1),
(5, 1, 1),
(5, 2, 1),
(5, 3, 1),
(5, 4, 1),
(5, 5, 1),
(5, 6, 1),
(5, 7, 1),
(5, 8, 1),
(5, 9, 1),
(5, 10, 1),
(6, 1, 1),
(6, 2, 1),
(6, 3, 1),
(6, 4, 1),
(6, 5, 1),
(6, 6, 1),
(6, 7, 1),
(6, 8, 1),
(6, 9, 1),
(6, 10, 1),
(7, 1, 1),
(7, 2, 1),
(7, 3, 1),
(7, 4, 1),
(7, 5, 1),
(7, 6, 1),
(7, 7, 1),
(7, 8, 1),
(7, 9, 1),
(7, 10, 1),
(8, 1, 1),
(8, 2, 1),
(8, 3, 1),
(8, 4, 1),
(8, 5, 1),
(8, 6, 1),
(8, 7, 1),
(8, 8, 1),
(8, 9, 1),
(8, 10, 1),
(9, 1, 1),
(9, 2, 1),
(9, 3, 1),
(9, 4, 1),
(9, 5, 1),
(9, 6, 1),
(9, 7, 1),
(9, 8, 1),
(9, 9, 1),
(9, 10, 1);
