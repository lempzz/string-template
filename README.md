# String template for models

We have table of articles:


| id | title                             | seo_title | created_at          |
|----|-----------------------------------|-----------|---------------------|
| 1  | Game of Thrones: New Episode      |           | 2019-05-13 18:04:43 |

and we need to show title of Article page with specific template, for example `{title}. Published at {date}`.

```js
$.ajax({
    url: '/articles/1',
    type: 'patch',
    dataType: 'json',
    data: {
        seo_title: '{title}. Published at {date}'
    },
    success: res => {
        console.log(res.data.seo_title) //Game of Thrones: New Episode. Published at 2019-05-13 18:04:43
    }
});
```

But if we want edit this Article, we will see original text:
```js
$.ajax({
    url: '/articles/1/edit',
    type: 'get',
    dataType: 'json',
    success: res => {
        console.log(res.data.seo_title) //{title}. Published at {date}
    }
});
``` 

