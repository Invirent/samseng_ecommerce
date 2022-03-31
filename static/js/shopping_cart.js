function calc(){
    var table = document.getElementById('shopping_cart');
    var rowCount = (table.length-1)/4;

    for (var i = 0; i < rowCount; i++) {
        quantity = document.getElementById('quantity['+ i +']').value;
        
        price = document.getElementById('price['+ i +']').value;
        var total =  quantity * price
        document.getElementById('total['+ i +']').value = total
      }
}