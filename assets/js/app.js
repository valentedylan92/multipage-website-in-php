// Get articles excerpts
function getArticlesExcerpts() {
    $.getJSON("includes/articles/articles.json", function(data) {
        // $.each(data.articles, function(i, item) {
        //     console.log(item);
        //     $articleExcerpt = '<h1 class="entry-title">' + item.title + '</h1>';
        //     $articleExcerpt += '<p>' + item.date + '</p>';
        //     $articleExcerpt += '<div>' + item.excerpt + '</div>';
        //     $('#mainContent').append($articleExcerpt);
        // });

        var temp = [];
        $.each(data.articles, function(key, value) {
            temp.push({ v: value, k: key });
        });
        // console.log('before');
        // console.log(temp);
        temp.sort(function(a, b) {
            if (a.v.id > b.v.id) { return -1 }
            if (a.v.id < b.v.id) { return 1 }
            return 0;
        });
        // console.log('after');
        // console.log(temp);
        $('#mainContent').empty();
        $.each(temp, function(key, obj) {
            $id = obj.v.id;
            $articleExcerpt = '<h1 class="entry-title"><a onclick="getArticle(' + obj.v.id + ')">' + obj.v.title + '</a></h1>';
            $articleExcerpt += '<p>' + obj.v.date + '</p>';
            $articleExcerpt += '<div>' + obj.v.excerpt + '</div>';
            $('#mainContent').append($articleExcerpt);
        });
    });
}
getArticlesExcerpts();

// Get all articles
function getAllArticles() {
    $.getJSON("includes/articles/articles.json", function(data) {
        var temp = [];
        $.each(data.articles, function(key, value) {
            temp.push({ v: value, k: key });
        });
        // console.log('before');
        // console.log(temp);
        temp.sort(function(a, b) {
            if (a.v.id > b.v.id) { return -1 }
            if (a.v.id < b.v.id) { return 1 }
            return 0;
        });
        // console.log('after');
        // console.log(temp);
        $('#mainContent').empty();
        $.each(temp, function(key, obj) {
            $article = '<h1 class="entry-title">' + obj.v.title + '</h1>';
            $article += '<p>' + obj.v.date + '</p>';
            $article += '<div>' + obj.v.content + '</div>';
            $('#mainContent').append($article);
        });
    });
}

// Get article by id
function getArticle(x) {
    $.getJSON("includes/articles/articles.json", function(data) {
        $.each(data.articles, function(i, item) {
            if (item.id === x) {
                $article = '<h1 class="entry-title">' + item.title + '</h1>';
                $article += '<p>' + item.date + '</p>';
                $article += '<div>' + item.content + '</div>';
                $('#mainContent').empty();
                $link = '<a onclick="getArticlesExcerpts()">Tous les articles</a>';
                $('#mainContent').append($link);
                $('#mainContent').append($article);
            }
        });
    });
}