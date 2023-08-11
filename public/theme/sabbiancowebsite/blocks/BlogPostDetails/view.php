<?php
	$url = parse_url(url()->current(), PHP_URL_PATH);
	$tempArr = explode("/",$url);
	if(count($tempArr)>3){
		$index = $tempArr[3];
	}else{
		$index = "";
	}
?>
<div class="inner-pages maxw1600 m0a dashboard-bd">
    <section class="blog blog-section bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 blog-pots">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="news-item details no-mb2">
                                <a href="blog-details.html" class="news-img-link">
                                    <div class="news-item-img">
                                        <img class="img-responsive" src="" id="image">
                                    </div>
                                </a>
                                <div class="news-item-text details pb-0">
                                    <h3 id="title"></h3>
                                    <!-- <div class="dates">
                                        <span class="date">April 11, 2020 &nbsp;/</span>
                                        <ul class="action-list pl-0">
                                            <li class="action-item pl-2"><i class="fa fa-heart"></i> <span>306</span></li>
                                            <li class="action-item"><i class="fa fa-comment"></i> <span>34</span></li>
                                            <li class="action-item"><i class="fa fa-share-alt"></i> <span>122</span></li>
                                        </ul>
                                    </div> -->
                                    <div class="news-item-descr big-news details visib mb-0">
                                        <p class="mb-3" id="content"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
	// window.addEventListener("load", (event) => {
        loadBlogpostsBlogPostDetails();
        
	// });
    function loadBlogpostsBlogPostDetails(){
        const sendData = {
            "id": '<?php echo $index; ?>',
        };
		const url = "/api/getblogposts";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
			data = JSON.parse(xhr.response);
			list = data.data[0];
            document.getElementById("image").src = list.image;
            document.getElementById("title").innerHTML = list.displayname;
            document.getElementById("content").innerHTML = list.displaydescription;
		}
	}
</script>
