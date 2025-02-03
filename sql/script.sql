DROP DATABASE IF EXISTS tea;
create database tea;
use tea;

CREATE TABLE tea_user (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    role ENUM('Admin', 'User') NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    date_of_birth DATE NOT NULL
);


-- Table pour les variétés de thé
CREATE TABLE tea_varieties (
    id_variete INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    occupation_per_plant DECIMAL(5, 2) NOT NULL, -- en m²
    yield_per_plant DECIMAL(5, 2) NOT NULL -- en kg/mois
);

-- Table pour les parcelles
CREATE TABLE tea_plots (
    id_plot INT AUTO_INCREMENT PRIMARY KEY,
    plot_number VARCHAR(50) NOT NULL UNIQUE,
    surface_area DECIMAL(10, 2) NOT NULL, -- en hectares
    id_variete INT,
    remaining_yield DECIMAL(10, 2) NOT NULL DEFAULT 0, -- en kg
    FOREIGN KEY (id_variete) REFERENCES tea_varieties (id_variete)
);

-- Table pour les cueilleurs
CREATE TABLE tea_pickers (
    id_picker INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    date_of_birth DATE NOT NULL
);

-- Table pour les catégories de dépenses
CREATE TABLE tea_expenseCategories (
    id_expenseCategories INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- Table pour les dépenses
CREATE TABLE tea_expenses (
    id_expense INT AUTO_INCREMENT PRIMARY KEY,
    expense_date DATE NOT NULL,
    id_expenseCategories INT,
    amount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_expenseCategories) REFERENCES tea_expenseCategories (id_expenseCategories)
);

-- Table pour les cueillettes
CREATE TABLE tea_pickings (
    id_picking INT AUTO_INCREMENT PRIMARY KEY,
    picking_date DATE NOT NULL,
    id_picker INT,
    id_plot INT,
    weight DECIMAL(10, 2) NOT NULL, -- en kg
    FOREIGN KEY (id_picker) REFERENCES tea_pickers (id_picker),
    FOREIGN KEY (id_plot) REFERENCES tea_plots (id_plot)
);

-- Table pour la configuration des salaires
CREATE TABLE tea_salaryConfig (
    id_salaire INT AUTO_INCREMENT PRIMARY KEY,
    amount_per_kg DECIMAL(10, 2) NOT NULL, -- montant par kg cueilli
    id_picker INT,
    FOREIGN KEY (id_picker) REFERENCES tea_pickers (id_picker)
);

-- Table pour la configuration des saisons de régénération
CREATE TABLE tea_regenerationSeasons (
    month INT NOT NULL,
    id_variete INT,
    isCheck INT,
    FOREIGN KEY (id_variete) REFERENCES tea_varieties (id_variete)
);

-- Table pour la configuration des poids et bonus/malus
CREATE TABLE tea_pickerConfig (
    id_pickerConfig INT AUTO_INCREMENT PRIMARY KEY,
    min_daily_weight DECIMAL(10, 2) NOT NULL, -- poids minimal journalier
    bonus_percentage DECIMAL(5, 2) NOT NULL, -- % de bonus
    malus_percentage DECIMAL(5, 2) NOT NULL, -- % de malus
    id_variete INT,
    FOREIGN KEY (id_variete) REFERENCES tea_varieties (id_variete)
);

-- Table pour les prix de vente par variété de thé
CREATE TABLE tea_prices (
    id_prices INT AUTO_INCREMENT PRIMARY KEY,
    sale_price DECIMAL(10, 2) NOT NULL, -- prix de vente par kg
    id_variete INT,
    FOREIGN KEY (id_variete) REFERENCES tea_varieties (id_variete)
);

-- Table pour les paiements des cueilleurs
CREATE TABLE tea_pickerPayments (
    id_pickerPayement INT AUTO_INCREMENT PRIMARY KEY,
    payment_date DATE NOT NULL,
    id_picker INT,
    total_weight DECIMAL(10, 2) NOT NULL, -- poids total cueilli
    total_amount DECIMAL(10, 2) NOT NULL, -- montant total à payer
    FOREIGN KEY (id_picker) REFERENCES tea_pickers (id_picker)
);

-- Table pour les prévisions
CREATE TABLE tea_forecasts (
    id_forecast INT AUTO_INCREMENT PRIMARY KEY,
    forecast_date DATE NOT NULL,
    id_plot INT,
    expected_yield DECIMAL(10, 2) NOT NULL, -- rendement prévu
    FOREIGN KEY (id_plot) REFERENCES tea_plots (id_plot)
);

-- Ajout de données pour tea_user
INSERT INTO tea_user (name, first_name, role, email, password, phone_number, gender, date_of_birth) VALUES
('Doe', 'John', 'Admin', 'john.doe@example.com', 'hashedpassword1', '1234567890', 'Male', '1985-06-15'),
('Smith', 'Jane', 'User', 'jane.smith@example.com', 'hashedpassword2', '0987654321', 'Female', '1990-03-22');

-- Ajout de données pour tea_varieties
INSERT INTO tea_varieties (name, occupation_per_plant, yield_per_plant) VALUES
('Assam', 1.5, 2.3),
('Darjeeling', 1.2, 1.8),
('Earl Grey', 1.8, 2.5);

-- Ajout de données pour tea_plots
INSERT INTO tea_plots (plot_number, surface_area, id_variete, remaining_yield) VALUES
('Plot-001', 2.5, 1, 500),
('Plot-002', 3.0, 2, 600),
('Plot-003', 1.8, 3, 400);

-- Ajout de données pour tea_pickers
INSERT INTO tea_pickers (full_name, gender, date_of_birth) VALUES
('Alice Brown', 'Female', '1988-07-12'),
('Bob White', 'Male', '1992-09-05');

-- Ajout de données pour tea_expenseCategories
INSERT INTO tea_expenseCategories (name) VALUES
('Maintenance'),
('Wages'),
('Equipment');

-- Ajout de données pour tea_expenses
INSERT INTO tea_expenses (expense_date, id_expenseCategories, amount) VALUES
('2024-01-15', 1, 1500.50),
('2024-01-20', 2, 3000.75);

-- Ajout de données pour tea_pickings
INSERT INTO tea_pickings (picking_date, id_picker, id_plot, weight) VALUES
('2024-02-01', 1, 1, 50.5),
('2024-02-02', 2, 2, 60.0);

-- Ajout de données pour tea_salaryConfig
INSERT INTO tea_salaryConfig (amount_per_kg, id_picker) VALUES
(2.5, 1),
(2.7, 2);

-- Ajout de données pour tea_regenerationSeasons
INSERT INTO tea_regenerationSeasons (month, id_variete, isCheck) VALUES
(3, 1, 1),
(4, 2, 0);

-- Ajout de données pour tea_pickerConfig
INSERT INTO tea_pickerConfig (min_daily_weight, bonus_percentage, malus_percentage, id_variete) VALUES
(40, 10, 5, 1),
(35, 12, 7, 2);

-- Ajout de données pour tea_prices
INSERT INTO tea_prices (sale_price, id_variete) VALUES
(10.50, 1),
(12.75, 2);

-- Ajout de données pour tea_pickerPayments
INSERT INTO tea_pickerPayments (payment_date, id_picker, total_weight, total_amount) VALUES
('2024-02-10', 1, 200, 500),
('2024-02-11', 2, 180, 486);

-- Ajout de données pour tea_forecasts
INSERT INTO tea_forecasts (forecast_date, id_plot, expected_yield) VALUES
('2024-03-01', 1, 520),
('2024-03-02', 2, 580);
