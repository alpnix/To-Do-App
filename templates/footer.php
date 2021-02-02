    <footer class="" style="color:#404040;">
        Alp Niksarli &copy 2021
    </footer>

    <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
        crossorigin="anonymous"></script>
    <script>
        // toggling the menu in and out for mobile devlices
        const toggler = document.querySelector(".navbar-toggler");
        const toggle_area = document.querySelector("#navbarsExampleDefault");
        toggler.addEventListener("click",function() {
            if (toggle_area.style.display == "block") {
                toggle_area.style.display = "none";
            } else {
                toggle_area.style.display = "block";
            }
        });
        // searching
        let searchForm = document.querySelector("#searchForm");
        let searchBtn = document.querySelector("#searchBtn");
        let tasks = document.querySelectorAll(".myHeading")
        let cards = document.querySelectorAll(".myCard");
        searchBar.addEventListener("change",function(e) {
            console.log(tasks.length);
            let searchText = e.target.value.toLowerCase();
            for (let i=0;i<tasks.length;i++) {
                let headingText = tasks[i].innerHTML.toLowerCase();
                if (headingText.includes(searchText)) {
                    cards[i].style.display = "block";
                } else {
                    cards[i].style.display = "none";
                }
            }
        });
        searchForm.addEventListener("submit",function(e) {
            e.preventDefault();
        });
        console.log(window.location);
    </script>
</body>