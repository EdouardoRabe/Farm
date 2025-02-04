INSERT INTO ferme_user (name, first_name, role, email, password, phone_number) 
VALUES 
('Rasoa', 'Ny Aina', 'Admin', 'rasoa.nyaina@example.com', 'password123', '0341234567');

INSERT INTO ferme_user (name, first_name, role, email, password, phone_number) 
VALUES 
('Rakoto', 'Andrianina', 'User', 'rakoto.andrianina@example.com', 'password456', '0339876543');

INSERT INTO ferme_user (name, first_name, role, email, password, phone_number) 
VALUES 
('Ravo', 'Noro', 'User', 'ravo.noro@example.com', 'password789', '0327654321');

INSERT INTO ferme_user (name, first_name, role, email, password, phone_number) 
VALUES 
('Andriamparany', 'Hery', 'Admin', 'andriamparany.hery@example.com', 'password101', '0346543210');












INSERT INTO ferme_gestion_capitaux (montant, capitaux_date, id_user) 
VALUES 
(10000.00, '2025-02-01', 1),  -- Rasoa Ny Aina (Admin)
(5000.00, '2025-02-01', 2),   -- Rakoto Andrianina (User)
(7500.50, '2025-02-01', 3),   -- Ravo Noro (User)
(12000.75, '2025-02-01', 4);  -- Andriamparany Hery (Admin)










INSERT INTO ferme_type_animal (espece, image, poids_minimal_vente, poids_maximal, prix_achat_kg, prix_vente_kg, jours_sans_manger, perte_poids_jour, consommation_jour)
VALUES 
('Zébu', 'zebu.jpg', 150.00, 400.00, 5000.00, 7500.00, 3, 2.00, 10.00),

('Canard', 'canard.jpg', 2.00, 5.00, 2000.00, 3500.00, 2, 0.50, 0.20),

('Poulet', 'poulet.jpg', 1.50, 3.00, 1500.00, 2500.00, 1, 0.25, 0.15),

('Cheval', 'cheval.jpg', 300.00, 700.00, 10000.00, 15000.00, 5, 3.00, 20.00),

('Mouton', 'mouton.jpg', 25.00, 100.00, 4000.00, 6000.00, 4, 1.50, 5.00),

('Vache', 'vache.jpg', 200.00, 600.00, 6000.00, 10000.00, 6, 2.50, 15.00);















INSERT INTO ferme_animal (id_typeAnimal, poids_initial) 
VALUES 
(1, 180.00),  -- Zébu
(2, 4.00),    -- Canard
(3, 2.00),    -- Poulet
(4, 350.00),  -- Cheval
(5, 40.00),   -- Mouton
(6, 500.00);  -- Vache










INSERT INTO ferme_alimentation (image, id_typeAnimal, prix_achat_kg, nom, pourcentage_gain)
VALUES 
('zebu_aliment.jpg', 1, 1500.00, 'Fourrage', 10.00),  -- Zébu
('canard_aliment.jpg', 2, 1000.00, 'Maïs', 8.00),    -- Canard
('poulet_aliment.jpg', 3, 800.00, 'Granulés', 12.00),  -- Poulet
('cheval_aliment.jpg', 4, 2000.00, 'Foin', 15.00),     -- Cheval
('mouton_aliment.jpg', 5, 1200.00, 'Herbe', 9.00),     -- Mouton
('vache_aliment.jpg', 6, 1800.00, 'Aliments concentrés', 20.00); -- Vache




INSERT INTO ferme_achat_alimentation (id_alimentation, quantiteKg, date_achat, id_user, montant)
VALUES 
(1, 100.00, '2025-02-01', 1, 150000.00),  -- Achat de Fourrage pour le Zébu
(2, 50.00, '2025-02-02', 2, 50000.00),   -- Achat de Maïs pour le Canard
(3, 200.00, '2025-02-03', 3, 160000.00), -- Achat de Granulés pour le Poulet
(4, 150.00, '2025-02-04', 4, 300000.00), -- Achat de Foin pour le Cheval
(5, 120.00, '2025-02-05', 1, 144000.00), -- Achat d'Herbe pour le Mouton
(6, 250.00, '2025-02-06', 2, 450000.00); -- Achat d'Aliments concentrés pour la Vache

INSERT INTO ferme_achat_animal (id_animal, date_achat, id_user, montant)
VALUES 
(1, '2025-02-01', 1, 200000.00),  -- Achat de Zébu (Animal avec id_animal = 1) par Rasoa Ny Aina
(2, '2025-02-02', 2, 15000.00),   -- Achat de Canard (Animal avec id_animal = 2) par Rakoto Andrianina
(3, '2025-02-03', 3, 5000.00),    -- Achat de Poulet (Animal avec id_animal = 3) par Ravo Noro
(4, '2025-02-04', 4, 500000.00),  -- Achat de Cheval (Animal avec id_animal = 4) par Andriamparany Hery
(5, '2025-02-05', 1, 80000.00),   -- Achat de Mouton (Animal avec id_animal = 5) par Rasoa Ny Aina
(6, '2025-02-06', 2, 250000.00);  -- Achat de Vache (Animal avec id_animal = 6) par Rakoto Andrianina


INSERT INTO ferme_vente_animal (id_animal, poids_vente, prix_vente, date_vente, id_user)
VALUES 
(1, 350.00, 250000.00, '2025-02-10', 1),  -- Vente de Zébu (id_animal = 1) par Rasoa Ny Aina
(2, 4.00, 15000.00, '2025-02-11', 2),     -- Vente de Canard (id_animal = 2) par Rakoto Andrianina
(3, 2.00, 8000.00, '2025-02-12', 3),      -- Vente de Poulet (id_animal = 3) par Ravo Noro
(4, 500.00, 450000.00, '2025-02-13', 4),   -- Vente de Cheval (id_animal = 4) par Andriamparany Hery
(5, 40.00, 30000.00, '2025-02-14', 1),     -- Vente de Mouton (id_animal = 5) par Rasoa Ny Aina
(6, 500.00, 550000.00, '2025-02-15', 2);   -- Vente de Vache (id_animal = 6) par Rakoto Andrianina
