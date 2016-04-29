; Change the spicy status of Eggplant with Chili Sauce
UPDATE dishes SET is_spicy = 1
              WHERE dish_name = 'Eggplant with Chili Sauce'

; Decrease the price of General Tso's Chicken
UPDATE dishes SET price = price - 1
              WHERE dish_name = 'General Tso\'s Chicken'
