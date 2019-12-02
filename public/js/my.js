var links = document.querySelectorAll(".nav__link");
var tabs = document.querySelectorAll(".tab__pane");
var forms = document.querySelectorAll(".form__toSubmit");

links.forEach(function(elem) {
    elem.addEventListener("click", function(e) {
        e.preventDefault();

        var href = this.getAttribute('href');

        if(href == 'updateUser' || href == 'updateRole'){
            href = href + 'ID-' + this.getAttribute('data-id');
        }
        var tab = document.querySelector("#" + href);



        tabs.forEach(function(item) {
            item.classList.remove('show', 'active');
        });

        tab.classList.add('show', 'active');
    });
});