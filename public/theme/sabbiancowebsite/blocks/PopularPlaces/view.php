<div class="homepage-9 hp-6 homepage-1 mh">
    <div id="wrapper">
        <section class="feature-categories bg-white rec-pro">
            <div class="container-fluid">
                <div class="sec-title">
                    <h2><span>Popular </span>Places</h2>
                    <p>Properties In Most Popular Places.</p>
                </div>
                <div class="row" id="popularPlaceContent">
                    <!-- Single category -->
                </div>
                <!-- /row -->
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    // window.addEventListener("load", (event) => {
        load_popularPlace();
	// });
    function load_popularPlace(){
		const url = "/api/activedistrict";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			data = JSON.parse(xhr.response);
            list = data.data;
            var temp ="";
            if(list.length >8){
                counter = 8;
            }else{
                counter = list.length;
            }
            for(i=0;i<counter;i++){
                temp += `<div class="col-xl-4 col-lg-6 col-sm-6" >
                        <div class="small-category-2">
                            <div class="small-category-2-thumb img-1">
                                <a href=""><img src="`+list[i].image+`" alt=""></a>
                            </div>
                            <div class="sc-2-detail">
                                <h4 class="sc-jb-title"><a href="">`+list[i].displayname+`</a></h4>
                                <span>`+list[i].listingCount+` Properties</span>
                            </div>
                        </div>
                    </div>`;
            }
            document.getElementById("popularPlaceContent").innerHTML = temp;
		}
	}
</script>