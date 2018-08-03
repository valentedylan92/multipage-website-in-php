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
            let id = obj.v.id;
            let articleExcerpt = '<h1 class="entry-title"><a onclick="getArticle(' + obj.v.id + ')">' + obj.v.title + '</a></h1>';
            articleExcerpt += '<p>' + obj.v.date + '</p>';
            articleExcerpt += '<div>' + obj.v.excerpt + '</div>';
            $('#mainContent').append(articleExcerpt);
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
            article = '<h1 class="entry-title">' + obj.v.title + '</h1>';
            article += '<p>' + obj.v.date + '</p>';
            article += '<div>' + obj.v.content + '</div>';
            $('#mainContent').append(article);
        });
    });
}

/* Get article by id */
function getArticle(x) {
    let indexes = [];
    let length = 0;
    // let test = [];
    $.getJSON("includes/articles/articles.json", function(data) {
        $.each(data.articles, function(i, item) {
            indexes.push(item.id);
            console.log(item);
            length++;
        });
        let key = indexes.indexOf(x);
        let previous = indexes.find(function(element) {
            return element < x;
        });
        let next = indexes.find(function(element) {
            return element > x;
        });
        // console.log(indexes);
        // let $previous = $indexes[x - 1];
        // let next = indexes[x + 1];
        $.each(data.articles, function(i, item) {
            if (item.id === x) {
                let article = '<h1 class="entry-title">' + item.title + '</h1>';
                article += '<p>' + item.date + '</p>';
                article += '<div>' + item.content + '</div>';
                $('#mainContent').empty();
                let linkAll = '<a id="allArticlesBtn" onclick="getArticlesExcerpts()">Tous les articles</a>';
                let linkPrev = '<a id="prevArticlesBtn" onclick="getArticle(' + (previous) + ')">Article précédent</a>';
                let linkNext = '<a id="nextArticlesBtn" onclick="getArticle(' + (next) + ')">Article suivant</a>';
                $('#mainContent').append(linkAll);
                $('#mainContent').append(article);
                $('#mainContent').append(linkPrev);
                $('#mainContent').append(linkNext);
                if (key == 0) {
                    $('#prevArticlesBtn').addClass('disabled');
                }
                if (key == (length - 1)) {
                    $('#nextArticlesBtn').addClass('disabled');
                }
            }
        });
    });
}