-- Ajouter des utilisateurs (admin et user)
INSERT INTO ferme_user (name, first_name, role, email, password, phone_number) VALUES
('Dupont', 'Jean', 'Admin', 'jean.dupont@example.com', 'admin123', '0612345678'),
('Martin', 'Sophie', 'User', 'sophie.martin@example.com', 'user123', '0698765432');

-- Ajouter des types d'animaux
INSERT INTO ferme_type_animal (espece, image, poids_minimal_vente, poids_maximal, prix_achat, prix_vente_kg, poids_initial, jours_sans_manger, perte_poids_jour, consommation_jour) VALUES
('Boeuf', 'boeuf.jpg', 300, 800, 500, 5, 250, 5, 2.5, 10),
('Mouton', 'mouton.jpg', 40, 120, 100, 7, 35, 3, 1.2, 3),
('Poulet', 'poulet.jpg', 2, 5, 5, 10, 1.8, 2, 0.2, 0.5);

-- Ajouter des animaux à la ferme
INSERT INTO ferme_animal (id_typeAnimal) VALUES
(1), (1), (2), (2), (3), (3), (3);

-- Ajouter des types d'aliments
INSERT INTO ferme_alimentation (image, id_typeAnimal, prix_achat, nom, pourcentage_gain, poids, quantiteKg) VALUES
('foin.jpg', 1, 0.5, 'Foin', 2, 10, 100),
('cereales.jpg', 2, 1.0, 'Céréales', 3, 5, 50),
('grains.jpg', 3, 0.8, 'Grains', 5, 1, 20);

-- Achats d'alimentation
INSERT INTO ferme_achat_alimentation (id_alimentation, quantiteKg, id_user, date_achat) VALUES
(1, 50, 1, '2025-01-01'),
(2, 20, 1, '2025-01-02'),
(3, 10, 1, '2025-01-03');

-- Achats d'animaux
INSERT INTO ferme_achat_animal (id_animal, date_achat, id_user) VALUES
(1, '2025-01-01', 1),
(2, '2025-01-02', 1),
(3, '2025-01-03', 2),
(4, '2025-01-03', 2),
(5, '2025-01-05', 1);

-- Ventes d'animaux après prise de poids
INSERT INTO ferme_vente_animal (id_animal, poids_vente, prix_vente, date_vente, id_user) VALUES
(1, 350, 1750, '2025-01-07', 1), -- Boeuf vendu après avoir gagné du poids
(3, 50, 350, '2025-01-05', 2), -- Mouton vendu avec bénéfice
(5, 3, 30, '2025-01-02', 1); -- Poulet vendu avec bénéfice

-- Gestion des capitaux (gains après ventes)
INSERT INTO ferme_gestion_capitaux (montant, capitaux_date, id_user) VALUES
(1750, '2025-01-01', 1),
(350, '2025-01-01', 2),
(30, '2025-01-03', 1);
