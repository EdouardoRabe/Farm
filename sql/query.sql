SELECT a.id_animal, animal.id_typeAnimal, a.date_achat, ta.prix_achat 
FROM ferme_achat_animal a
JOIN ferme_animal animal ON animal.id_animal = a.id_animal
JOIN ferme_type_animal ta ON animal.id_typeAnimal = ta.id_typeAnimal
WHERE a.date_achat = '2025-02-03';
