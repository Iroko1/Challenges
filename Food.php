<?php
// Food Menu
$menu = [
    1 => ["1: Hot Dog" => 2.50,
    "quantity" => 0],
    2 => ["2: Pizza Slice" => 3.50,
    "quantity" => 0],
    3 => ["3: Hamburger" => 5.00,
    "quantity" => 0],
    4 => ["4: Fries" => 2.00,
    "quantity" => 0],
    5 => ["5: Soda" => 2.00,
    "quantity" => 0],
    6 => ["6: Water" => 1.00,
    "quantity" => 0]
];

// prints the order and calculates the total
function order() {
    global $menu;
    $total = 0;
    // Gets the total of the order from the quantity of each item
    foreach ($menu as $item) {
        $total += $item[key($item)] * $item['quantity'];
    }
    if ($total == 0) {
        print("You have not ordered anything.\n");
        readline("Press enter to continue.");
        return;
    }
    print("Subtotal: $" . $total . "\n");
    print("Tax: $" . round($total * 0.055, 2) . "\n");
    print("Total: $" . round($total * 1.055, 2) . "\n");
}

// clears the quantity of each item
function clear() {
    global $menu;
    foreach ($menu as $key => $value) {
        $menu[$key]['quantity'] = 0;
    }
}



// Main loop
while (true) {


    system('cls');
    print("Welcome to the Food Truck!\n");

    // prints the menu depending on the quantity of each item
    foreach ($menu as $item) {
        if ($item['quantity']) {
            print(key($item) . " - $" . $item[key($item)] . " x[" . $item['quantity'] . "]\n");
        } else {
            print(key($item) . " - $" . $item[key($item)] . "\n");
        }
    }

    // prints the options
    print("\n5.5% sales tax will be added to your order.\n");
    print("\n< - Options - >\n");
    print("a: Order\n");
    print("b: Clear\n");
    print("c: Exit\n");
    print("Please enter the number of the item you would like to order or select an option.\n");

    // reads the option
    $option = strtolower(readline("->: "));
    switch ($option) {
        case "1":
            print("How many Hot Dogs would you like to order?\n");

            // reads the quantity of the item
            $order = (int)readline("->: ");

            // updates the quantity of the item
            $menu[1]["quantity"] = $order;
            break;
        
        case "2":
            print("How many Pizza Slices would you like to order?\n");
            $order = (int)readline("->: ");
            $menu[2]["quantity"] = $order;
            break;

        case "3":
            print("How many Hamburgers would you like to order?\n");
            $order = (int)readline("->: ");
            $menu[3]["quantity"] = $order;
            break;

        case "4":
            print("How many Fries would you like to order?\n");
            $order = (int)readline("->: ");
            $menu[4]["quantity"] = $order;
            break;

        case "5":
            print("How many Sodas would you like to order?\n");
            $order = (int)readline("->: ");
            $menu[5]["quantity"] = $order;
            break;

        case "6":
            print("How many Waters would you like to order?\n");
            $order = (int)readline("->: ");
            $menu[6]["quantity"] = $order;
            break;

        case "a":
            order();
            break;

        case "b":
            clear();
            break;
        
        case "c":
            $txt = readline("Are you sure you want to exit? (y/n)\n");
            if ($txt == "y") {
                exit();
            } else {
                break;
            }

        default:
            // if the option is invalid, the user is prompted to enter a valid option
            print("Invalid option.\n");
            break;

    }

}

