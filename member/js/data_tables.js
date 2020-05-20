$(function () {
    $('.data_table').DataTable({
        responsive: true,
        iDisplayLength: 20,
        aLengthMenu: [[20, 50, 100, 200, -1], [20, 50, 100, 200, "All"]]
    });
});