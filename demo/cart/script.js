jQuery(function ($) {
    var shoppingCart = (function () {
        var cart = [];

        function Item(name, price, count) {
            this.name = name;
            this.price = price;
            this.count = count;
        }

        function saveCart() {
            localStorage.setItem('shoppingCart', JSON.stringify(cart));
        }

        function loadCart() {
            cart = JSON.parse(localStorage.getItem('shoppingCart')) || [];
        }

        if (localStorage.getItem("shoppingCart") != null) {
            loadCart();
        }

        var obj = {};

        obj.addItemToCart = function (name, price, count) {
            for (var item in cart) {
                if (cart[item].name === name) {
                    cart[item].count++;
                    saveCart();
                    return;
                }
            }
            var item = new Item(name, price, count);
            cart.push(item);
            saveCart();
        };

        obj.setCountForItem = function (name, count) {
            for (var i in cart) {
                if (cart[i].name === name) {
                    cart[i].count = count;
                    break;
                }
            }
            saveCart();
        };

        obj.removeItemFromCart = function (name) {
            for (var item in cart) {
                if (cart[item].name === name) {
                    cart[item].count--;
                    if (cart[item].count === 0) {
                        cart.splice(item, 1);
                    }
                    break;
                }
            }
            saveCart();
        };

        obj.removeItemFromCartAll = function (name) {
            for (var item in cart) {
                if (cart[item].name === name) {
                    cart.splice(item, 1);
                    break;
                }
            }
            saveCart();
        };

        obj.clearCart = function () {
            cart = [];
            saveCart();
        };

        obj.totalCount = function () {
            var totalCount = 0;
            for (var item in cart) {
                totalCount += cart[item].count;
            }
            return totalCount;
        };

        obj.totalCart = function () {
            var totalCart = 0;
            for (var item in cart) {
                totalCart += cart[item].price * cart[item].count;
            }
            return Number(totalCart.toFixed(2));
        };

        obj.listCart = function () {
            var cartCopy = [];
            for (var i in cart) {
                var item = cart[i];
                var itemCopy = {};
                for (var prop in item) {
                    itemCopy[prop] = item[prop];
                }
                itemCopy.total = Number(item.price * item.count).toFixed(2);
                cartCopy.push(itemCopy);
            }
            return cartCopy;
        };

        return obj;
    })();

    $('.add_to_cart_button').click(function (event) {
        event.preventDefault();
      
        var name = $(this).data('name');
        var price = Number($(this).data('price'));
        var image = $(this).data('image');
      
        shoppingCart.addItemToCart(name, price, 1);
      
        displayCart();
        updateCartTable();
        updateHiddenFields(); // Call the updateHiddenFields function
    });
      
    function updateHiddenFields() {
        var cartArray = shoppingCart.listCart();

        // Remove existing hidden fields
        $('#updateCartForm input[name^="cart_item_"]').remove();

        // Add new hidden fields based on the cart data
        for (var i in cartArray) {
            var item = cartArray[i];

            $('<input>').attr({
                type: 'hidden',
                name: 'cart_item_name[]',
                value: item.name
            }).appendTo('#updateCartForm');

            $('<input>').attr({
                type: 'hidden',
                name: 'cart_item_price[]',
                value: item.price
            }).appendTo('#updateCartForm');

            $('<input>').attr({
                type: 'hidden',
                name: 'cart_item_quantity[]',
                value: item.count
            }).appendTo('#updateCartForm');
        }
    }

    function updateCartTable() {
        var cartBody = $('#cartBody');
        var cartArray = shoppingCart.listCart();

        // Clear the existing rows
        $(cartBody).empty();

        // Add new rows
        for (var i in cartArray) {
            var item = cartArray[i];

            var newRow = "<tr>" +
                "<td class='product-remove'><a href='#'>x</a></td>" +
                "<td class='product-thumbnail'><a href='shop-single.php'><img src='" + item.image + "' alt=''></a></td>" +
                "<td class='product-name'><a href='shop-single.php'>" + item.name + "</a></td>" +
                "<td class='product-price'><span class='product-amount'><span class='price-symbol'>$</span>" + item.price.toFixed(2) + "</span></td>" +
                "<td class='product-quantity'><div class='quantity product-number position-relative d-flex'>" +
                "<div class='d-xl-none product-btn plus'>+</div>" +
                "<input type='number' min='1' value='" + item.count + "' class='quantity-product' id='quantityInput'>" +
                "<div class='d-xl-none product-btn minus'>-</div>" +
                "</div></td>" +
                "<td class='product-subtotal'><span class='product-amount'><span class='price-symbol'>$</span>" + item.total + "</span></td>" +
                "</tr>";

            $(cartBody).append(newRow);
        }
    }

    function displayCart() {
        console.log('Cart updated');
        // You can add more display logic here based on your requirements
    }

    $(document).ready(function () {
        // Click event for 'add_to_cart_button'
        $('.product-button-container a.add_to_cart_button').click(function (e) {
            e.preventDefault();
            var container = $(this).closest('.product-button-container');
            container.find('a.add_to_cart_button').hide();
            container.find('a.added_to_cart').show();
        });

        // Click event for 'added_to_cart'
        $('.product-button-container a.added_to_cart').click(function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            window.location.href = href;
        });
    });

    // Add a function to dynamically update hidden fields
    function updateCartFormFields() {
        var cartArray = shoppingCart.listCart();
    
        // Remove existing hidden fields
        $('#updateCartForm input[name^="cart_item_"]').remove();
    
        // Add new hidden fields based on the cart data
        for (var i in cartArray) {
            var item = cartArray[i];
    
            $('<input>').attr({
                type: 'hidden',
                name: 'cart_item_name[]',
                value: item.name
            }).appendTo('#updateCartForm');
    
            $('<input>').attr({
                type: 'hidden',
                name: 'cart_item_price[]',
                value: item.price
            }).appendTo('#updateCartForm');
    
            $('<input>').attr({
                type: 'hidden',
                name: 'cart_item_quantity[]',
                value: item.count
            }).appendTo('#updateCartForm');
        }
    }
});
