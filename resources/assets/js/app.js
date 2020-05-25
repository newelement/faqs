(function(){
    let HTTP;

    function faqVote(id, vote, target){
        let formData = new FormData;
        formData.append('id', id);
        formData.append('vote', vote);

        let url = '/faqs-vote';
        HTTP.post(url, formData)
        .then(response => {
            let newNode = document.createElement('span');
            newNode.innerHTML = 'Thanks!';
            newNode.classList.add('faqs-vote-thanks');
            target.after(newNode);
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

        let $faqVotes = document.querySelectorAll('.faq-vote');
        if( $faqVotes.length ){
            $faqVotes.forEach( (v) => {
                v.addEventListener('click', (e) => {
                    e.preventDefault();
                    let id = e.target.getAttribute('data-id');
                    let vote = e.target.getAttribute('data-vote');
                    faqVote(id, vote, e.target);
                });
            });
        }

    });

})();
