; Retrieve all rows in which dish name begins with D
SELECT * FROM dishes WHERE dish_name LIKE 'D%'

; Retrieve rows in which dish name is Fried Cod, Fried Bod,
; Fried Nod, and so on.
SELECT * FROM dishes WHERE dish_name LIKE 'Fried _od'
