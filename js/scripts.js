/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation Desktop
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    // Toggle the side navigation Mobile
    const sidebarToggleMobile = document.body.querySelector('#sidebarToggle-m');
    const collapseIcon = document.body.querySelector('#collapse_icon');

    if (sidebarToggleMobile) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggleMobile.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-m-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-m-toggled'));
            collapseIcon.classList.toggle('fa-xmark');
        });
    }

    // DataTable
    //ตารางรายการเงินเดือนย้อนหลัง
    const datatablesSimple = document.getElementById('datatablesSimple');
    const usersDataTable = document.getElementById('usersDataTable');

    if (datatablesSimple) {
        let options = {
            searchable: false,
            perPageSelect: false,
            perPage: 10,
            labels: {
                noRows: 'ไม่พบข้อมูล',
                noResults: "ไม่พบข้อมูลที่ต้องการ",
                info: "แสดงรายการที่ {start}  ถึง {end} จากทั้งหมด {rows} รายการ",
            }             
        };
        new simpleDatatables.DataTable(datatablesSimple ,options);
    }

    if (usersDataTable) {
        let options = {
            searchable: true,
            perPageSelect: false,
            perPage: 20, 
            fixedColumns: true,
            columns: [
                {select: 0 , cellClass: 'text-center',headerClass: 'bg-primary text-white',searchable: false},
                {select: 1 , cellClass: 'text-center',headerClass: 'bg-primary text-white'},
                {select: 2 ,headerClass: 'bg-primary text-white',searchable: false},
                {select: 3 , cellClass: 'text-center',headerClass: 'bg-primary text-white',searchable: false},
                {select: 4 , cellClass: 'text-center',headerClass: 'bg-warning',searchable: false},
                {select: 5 , cellClass: 'text-center',headerClass: 'bg-danger text-white',searchable: false},
            ],
            labels: {
                placeholder: 'ค้นหาจากรหัสพนักงาน',
                noRows: 'ไม่พบข้อมูล',
                noResults: "ไม่พบข้อมูลที่ต้องการ",
                info: "แสดงรายการที่ {start}  ถึง {end} จากทั้งหมด {rows} รายการ",
            }         
        };
        new simpleDatatables.DataTable(usersDataTable ,options);
    }
});



