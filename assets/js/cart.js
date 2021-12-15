var cart = {
  // (A) HELPER - AJAX FETCH
  ajax : (data, after) => {
    // (A1) FORM DATA
    let form = new FormData();
    for (let [k, v] of Object.entries(data)) { form.append(k, v); }

    // (A2) FETCH
    fetch("config/ajax-cart.php", { method:"POST", body:form })
    .then((res) => res.json()).then((res) => {
      if (res.status!== 1) { 
        alert(res.msg); 
      } else if (after) { 
        after(res.msg); 
      }
    }).catch((err) => {
      // alert("Error");
      console.log("Error:", err);
    });
  },

  // (B) SHOW ITEMS IN CART
  show : () => {
    cart.ajax({ req : "get" }, (items) => {
      // (B1) GET HTML CART
      let hcart = document.getElementById("cart");
      hcart.innerHTML = "";

      // (B2) EMPTY CART
      if (items===null) { hcart.innerHTML = "Cart is empty."; }

      // (B3) DRAW CART ITEMS
      else {
        let total = 0;
        for (let [id, pdt] of Object.entries(items)) {
          // ITEM ROW HTML ELEMENTS
          let row = document.createElement("div"),
              rowA = document.createElement("button"),
              rowB = document.createElement("div"),
              rowC = document.createElement("input");

          // DELETE BUTTON
          rowA.innerHTML = "X";
          rowA.onclick = () => { cart.del(id); };
          rowA.className = "cDel";
          row.appendChild(rowA);

          // NAME
          rowB.innerHTML = pdt.name;
          rowB.className = "cName";
          row.appendChild(rowB);

          // QUANTITY
          rowC.type = "number";
          rowC.value = pdt.qty;
          rowC.min = 0; rowC.max = 99;
          rowC.onchange = function () { cart.set(id, this.value); };
          rowC.className = "cQty";
          row.appendChild(rowC);

          // ADD TO GRAND TOTAL
          total += pdt.qty * pdt.price;

          // ENTIRE ROW
          row.className = "cRow";
          hcart.appendChild(row);
        }

        // GRAND TOTAL
        let row = document.createElement("div");
        row.innerHTML = "TOTAL $" + total.toFixed(2);
        row.className = "cTotal";
        hcart.appendChild(row);

        // CHECKOUT
        row = document.createElement("button");
        row.innerHTML = "Checkout";
        row.className = "cOut cart-button";
        row.onclick = () => { 
          // Redirect to checkout page when "floating cart" CHECKOUT button is clicked
          location.href = 'checkout.php'; 
        };
        hcart.appendChild(row);

        // EMPTY CART
        row = document.createElement("button");
        row.innerHTML = "Empty";
        row.className = "cNuke cart-button";
        // let confirmDelete = () => window.confirm('Are you sure you want to empty your cart?');// cart.nuke;
        row.onclick = cart.nuke;
        hcart.appendChild(row);
      }
    });   
  },

  // (C) ADD ITEM TO CART
  add : (pid) => {
    const cartEl = document.getElementsByClassName('cart')[0];
    cartEl.classList.add('show-cart');
    cart.ajax({ req : "add", pid : pid }, cart.show);
  },

  // (D) CHANGE QUANTITY
  set : (pid, qty) => {
    cart.ajax({ req : "set", pid : pid, qty : qty }, cart.show);
  },

  // (E) REMOVE ITEM
  del : (pid) => {
    cart.ajax({ req : "del", pid : pid }, cart.show);
  },

  // (F) NUKE
  nuke : () => { if (confirm("Empty cart?")) {
    cart.ajax({ req : "nuke" }, cart.show);
  }}
};

  
const showHideCart = () => {
  let cartShowing = true;
  const cartEl = document.getElementsByClassName('cart')[0]
  const headerCartIcon = document.getElementById("header-cart-icon");
  const addToCartButton = document.getElementsByClassName('add-button')

  // Close the floating cart if we click anywhere on the page (that's not the cart itself)
  document.addEventListener("click", (evt) => {
      let targetEl = evt.target; // clicked element      
      do {
        if (targetEl === cartEl && addToCartButton) {
          // cart is showing && we're clicking inside it. just return.
          return;
        }
        // Go up the DOM
        targetEl = targetEl.parentNode;
      } while (targetEl);
      if (evt.target === headerCartIcon) {
        // This is a click outside. 
        cartShowing = cartEl.classList.contains('show-cart') ? true : false;
        return;
      }
      cartEl.classList.add("hidden")
      cartShowing = false;
  });

  // Show cart when we add to cart clicked
  btns = [...addToCartButton];
  for (var i = 0; i < btns.length; i++) {
    addToCartButton[i].addEventListener('click', (evt) => {
      evt.preventDefault();
      cartShowing = true; 
    })
  } 
  
  // Toggle header cart
  headerCartIcon.addEventListener('click', (evt) => {
    evt.preventDefault();
    if (cartShowing) {
      cartShowing = false
      cartEl.classList.remove('hidden')
    } else {
      cartShowing = true
     cartEl.classList.add('hidden')
    }
  })
}

window.addEventListener("DOMContentLoaded", cart.show)
window.addEventListener("DOMContentLoaded", showHideCart)

