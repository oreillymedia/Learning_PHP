; Dishes with price greater than 5.00
SELECT dish_name, price FROM dishes WHERE price > 5.00

; Dishes whose name exactly matches "Walnut Bun"
SELECT price FROM dishes WHERE dish_name = 'Walnut Bun'

; Dishes with price more than 5.00 but less than or equal to 10.00
SELECT dish_name FROM dishes WHERE price > 5.00 AND price <= 10.00

; Dishes with price more than 5.00 but less than or equal to 10.00,
; or dishes whose name exactly matches "Walnut Bun" (at any price)
SELECT dish_name, price FROM dishes WHERE (price > 5.00 AND price <= 10.00)
       OR dish_name = 'Walnut Bun'
