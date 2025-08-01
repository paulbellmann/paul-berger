{extends file="base.tpl"}

{block name="title"}
    {$title}
{/block}

{block name="body"}
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Bereich</th>
                <th>Anzahl</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$data item=item}
                <tr>
                    <td>{$item['range']}</td>
                    <td>{$item['count']}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>

    <a href="/">Zurück</a>
{/block}