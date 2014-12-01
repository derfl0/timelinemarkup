$(document).ready(function() {
    $('.timeline').each(function(index, container) {
        var chart = new google.visualization.Timeline(container);
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn('string', 'Employee Name');
        dataTable.addColumn('datetime', 'Hire Date');
        dataTable.addColumn('datetime', 'Emd Date');
console.log(window[container.id]); 
       dataTable.addRows(window[container.id]);
        chart.draw(dataTable);
    });

});