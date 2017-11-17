function loadContentsData(data) {
    function download(id) {
        $.get("/functions/get_download_url.php", {
            id: id,
        }).done(function onSuccess(url) {
            if (url.length !== 0) {
                window.open(url);
            } else {
                alert("이용중인 기기에서 지원하지 않는 콘텐츠입니다.");
            }
        }).fail(function onFail() {
            alert("이용중인 기기에서 지원하지 않는 콘텐츠입니다.");
        });
    }

    function loadThumbnail($section, thumbnailURL) {
        $.ajax({
            type: "HEAD",
            url: thumbnailURL,
            success: function onSuccess() {
                $section.find(".cover img").attr("src", thumbnailURL);
            },
            error: function onError() {
                $section.find(".cover img").attr("src", "/images/logo_dark.png");
            },
        });
    }

    function loadOrbit($modal, contentsData) {
        var orbitData = [];
        var datum;
        var images;
        var orbit;
        var i;

        if (contentsData.Images.length === 0) {
            datum = {};
            datum.ID = 0;
            datum.Image = "/images/dalchong.jpg";
            datum.Summary = "등록된 이미지가 없습니다.";
            datum.Actived = 1;
            orbitData.push(datum);
        } else {
            images = contentsData.Images;
            for (i = 0; i < images.length; i++) {
                datum = {};
                datum.ID = i;
                datum.Image = images[i];
                datum.Actived = 1;
                orbitData.push(datum);
            }
        }

        orbit = $modal.find(".orbitArea").get(0);
        (Orbit).call(orbit);
        orbit.load(orbitData);

        updateOrbitHeight(orbit);
        $(window).on("resize", function () { updateOrbitHeight(orbit); });
    }

    function openModal() {
        var datum = data[parseInt($(this).data("contents-index"), 10)];
        var $origin = $(".modal-origin[name=contents-detail]");
        var $modal = $origin.get(0).open();
        var genres = datum.Genres.join(", ");
        var platforms = datum.Platforms.join(", ");

        $modal.find(".summary .title").text(datum.Title);
        $modal.find(".summary .creator").text(datum.Creator);
        $modal.find(".summary .genres").text(genres);
        $modal.find(".summary .platforms").text(platforms);
        $modal.find(".download").on("click", function () { download(datum.ID); });

        loadThumbnail($modal, datum.Thumbnail);
        loadOrbit($modal, datum);
    }

    function updateOrbitHeight(orbit) {
        $(orbit).height($(orbit).width() * 0.56);
    }

    function loadAllThumbnails() {
        var datum;
        var $section;
        var i;

        for (i = 0; i < data.length; i += 1) {
            datum = data[i];
            $section = $("<section/>")
                .html($("#contents .contents-list template").html())
                .data("contents-index", i)
                .on("click", openModal)
                .appendTo("#contents .contents-list");

            $section.find(".summary .title").text(datum.Title);
            $section.find(".summary .creator").text(datum.Creator);

            loadThumbnail($section, datum.Thumbnail);
        }
    }

    loadAllThumbnails();
}