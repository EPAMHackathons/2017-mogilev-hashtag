<div>
    <div class="container">
        <div class="col-md-12 block-content block_white">
            {if $unsubscribed  eq '1'}
            <h1> <span>Поздравляем</span></h1>
            <p>Вы успешно отписались от рассылки</p>
                <br/>
            {else}
                <h1> <span>404 error</span></h1>
                <p>Запрашиваемая Вами страница не найдена</p>
            <br/>
            {/if}
            <a style="text-align:center;width:320px;margin:0 auto;display:block;" href="/" class="btn btn-large  btn-yellow btn-purple btn-5a fa fa-reply btn-pop-up-view"><span>На главную</span></a>
            <br/>
            <h3><span> Или посетите наш каталог</span></h3>
            <ul class="error404">{$catalog}</ul>
        </div>
    </div>
</div>