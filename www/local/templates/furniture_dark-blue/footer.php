<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
			</div>
		</div>
		<div id="space-for-footer"></div>
	</div>
	
	<div id="footer">
	
		<div id="copyright">
<?
$APPLICATION->IncludeFile(
	SITE_DIR."include/copyright_datainlife.php",
	Array(),
	Array("MODE"=>"html")
);
?>
		</div>
		<div class="footer-links">	

		</div>
		<div id="footer-design"><?=GetMessage("FOOTER_DISIGN")?></div>
	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function slowScroll(id) {
            $('html, body').animate({
                scrollTop: $(id).offset().top //скролить сверху объект по id отступ offset() сверху top
            }, 500); // 1ый параметр ф-ция что делать animate 2ой время 500мс
        }

        $(document).on("scroll", function () {
            if($(window).scrollTop() === 0)
                $("header").removeClass("fixed");
            else
                $("header").attr("class", "fixed");
        });
    </script>
</body>
</html>