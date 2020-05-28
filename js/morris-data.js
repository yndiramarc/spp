$(function() {

 
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [
        {
            label: "Atuneras",
            value: 98
        }, 
         {
            label: "Industrial Polivalente",
            value: 40
        }, 
        {
            label: "Artesanal Gran Escala",
            value: 226
        }, 
        {
            label: "Artesanal Pequeña Escala",
            value: 3234
        }
        
             
        
        ],
        resize: true
    });

    

});
