<?php
 if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
 }else{
    $user_id = "";
 }
?>
    <div class="inner-pages homepage-4 agents hp-6 full hd-white">
    <section class="blog-section">
            <div class="container">
                <div class="news-wrap">
                    <div class="row" id="ListingListContent"></div>
                </div>
                <nav aria-label="..." class="pt-3">
                    <ul class="pagination mt-0" id="pagin_content" style="display: flex;justify-content: center;">
                        
                    </ul>
                </nav>
                <input type="hidden" id="page_index" value="1">
            </div>
        </section>
    </div>
<script type="text/javascript">
    var countries = [];
	window.addEventListener("load", (event) => {
        load_blogposts();
	});
    
    function load_blogposts(){
        const sendData = {
            "id":"",
            "blog_id":"<?php echo $block->setting("blog_id"); ?>",
            "perpage":20,
            "page":document.getElementById("page_index").value
        };
		const url = "/api/getblogposts";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
			data = JSON.parse(xhr.response);
			list = data.data;
            var temp = "";
            temp = "";
            for(i= 0; i<list.length; i++)
            {
                tempStr = list[i].displaydescription;
                tempStr = tempStr.substring(0,450) + "...";
                temp +=` <div class="col-md-12 col-xs-12" style="margin: 0px 0px 15px 0px;">
                            <div class="news-item news-item-sm" style="height: auto">
                                <a href="`+list[i].link+`" class="news-img-link" style="flex-basis:25%">
                                    <div class="news-item-img">
                                        <img class="resp-img" src="`+list[i].image+`" style="height: 220px;padding: 10px;">
                                    </div>
                                </a>
                                <div class="news-item-text">
                                    <a href="`+list[i].link+`"><h3>`+ list[i].displayname + `</h3></a>
                                    <div class="news-item-descr" style="height:105px !important;">
                                        <p>`+ list[i].short_description +`</p>
                                    </div>
                                    <div class="news-item-bottom">
                                        <a href="`+list[i].link+`" class="news-link">Read more...</a>
                                    </div>
                                </div>
                            </div>
                        </div>`;
            }
            document.getElementById("ListingListContent").innerHTML = temp;

            sendData1 = {
                "total": data.total,
                "current_page": data.current_page,
                "per_page": data.per_page,
            }
            const url1 = "/api/getpagination";
            let xhr1 = new XMLHttpRequest();
            xhr1.open('POST', url1, true);
            xhr1.setRequestHeader('Content-type', 'application/json');
            xhr1.send(JSON.stringify(sendData1));
            xhr1.onload = function () {
                data1 = JSON.parse(xhr1.response);
                list1 = data1.links;
                temp1 = "";
                if(window.innerWidth > 650){
                    for(j=0;j<list1.length;j++){
                        tempUrl = list1[j].url;
                        if(tempUrl == null){
                            tempIndex = null;
                        }else{
                            tempIndex = tempUrl.substring(tempUrl.indexOf("?page=")+6);
                        }
                        flag = "";
                        if(list1[j].active){
                            flag = "active";
                        }
                        temp1 += `<li class="page-item `+flag+`"><a class="page-link" onclick="loadPageBlogPost(`+tempIndex+`)">`+list1[j].label+`</a></li>`;
                    }
                }else{
                    for(j=0;j<list1.length;j++){
                        tempUrl = list1[j].url;
                        if(tempUrl == null){
                            tempIndex = null;
                        }else{
                            tempIndex = tempUrl.substring(tempUrl.indexOf("?page=")+6);
                        }
                        if(j==0 || j == list1.length-1){
                            temp1 += `<li class="page-item"><a class="page-link" onclick="loadPageBlogPost(`+tempIndex+`)">`+list1[j].label+`</a></li>`;    
                        }else{
                            if(list1[j].active){
                                flag = "active";
                                temp1 += `<li class="page-item `+flag+`"><a class="page-link" onclick="loadPageBlogPost(`+tempIndex+`)">`+list1[j].label+`</a></li>`;
                            }
                        }
                    }
                }
                document.getElementById("pagin_content").innerHTML = temp1;
            }
		}
	}
    function loadPageBlogPost(index){
        document.getElementById("page_index").value = index;
		load_blogposts();
	}
</script>