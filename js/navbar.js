 document.addEventListener('DOMContentLoaded', function () {


     var elems = document.querySelectorAll('.sidenav');
     var instances = M.Sidenav.init(elems);

     var elems = document.querySelectorAll('.dropdown-trigger');
     var instances = M.Dropdown.init(elems, {
         inDuration: 300,
         outDuration: 225,
         hover: true,
         coverTrigger: false,
         alignment: 'left',

     });
     var el = document.querySelectorAll('.tabs');
     var instance = M.Tabs.init(el);
 });
