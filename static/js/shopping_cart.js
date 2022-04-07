function calc(){
    var table = document.getElementById('shopping_cart');
    var rowCount = (table.length)/5;
    for (var i = 0; i < rowCount; i++) {
        quantity = document.getElementById('quantity_'+ i).value;
        
        price = document.getElementById('price_'+ i).value;
        var total =  quantity * price
        document.getElementById('total_'+ i).value = total
      }
}