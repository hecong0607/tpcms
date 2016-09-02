<style>
    .home_info li em {
        float: left;
        width: 120px;
        font-style: normal;
    }

    li {
        list-style: none;
    }
</style>
<div class="wrap">
    <h4 class="well">系统信息</h4>

    <div class="home_info">
        <ul>
            <foreach name="info" item="v">
                <li><em>{$v['key']}</em> <span>{$v['value']}</span></li>
            </foreach>
        </ul>
    </div>
</div>