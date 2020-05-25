(function(){

    let HTTP;

    function updateFaqSort(){
        let items = document.querySelectorAll('.faq-item');
        let formData = new FormData;
        items.forEach((v) => {
            let id = v.getAttribute('data-id');
            formData.append('items[]', id);
        });

        let url = '/admin/faqs/update/sort';
        HTTP.post(url, formData)
            .then(response => {
            })
            .catch(e => {
                console.log('sort error');
            });
    }

    function updateFaqGroupSort(){
        let items = document.querySelectorAll('.faq-item');
        let formData = new FormData;
        items.forEach((v) => {
            let id = v.getAttribute('data-id');
            formData.append('items[]', id);
        });

        let url = '/admin/faq-group/update/sort';
        HTTP.post(url, formData)
            .then(response => {
            })
            .catch(e => {
                console.log('sort error');
            });
    }

    document.addEventListener("DOMContentLoaded", function(){
        HTTP = axios.create(axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN' : app.csrfToken,
            'Content-Type': 'multipart/form-data'
        });

        let $faqsList = document.querySelector('.faqs-table tbody');
        if( $faqsList ){
            sortable.create($faqsList, {
                handle: '.sort-handle',
                easing: "cubic-bezier(1, 0, 0, 1)",
                animation: 150,
                onEnd: function (e) {
                    updateFaqSort();
                },
                onAdd: function (e) {
                },
                onStart: function (evt) {
                },
            });
        }

        let $faqGroupList = document.querySelector('.faq-group-table tbody');
        if( $faqGroupList ){
            sortable.create($faqGroupList, {
                handle: '.sort-handle',
                easing: "cubic-bezier(1, 0, 0, 1)",
                animation: 150,
                onEnd: function (e) {
                    updateFaqGroupSort();
                },
                onAdd: function (e) {
                },
                onStart: function (evt) {
                },
            });
        }

    });

})();
