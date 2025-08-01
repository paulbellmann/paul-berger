{extends file="base.tpl"}

{block name="title"}
    {$title}
{/block}

{block name="body"}
    <h1>{$title}</h1>

    {if $item}
        <form action="/update/{$item->id}" method="post" class="mb-4">
            <div class="mb-3">
                <label for="id" class="form-label">Artikelnumer</label>
                <input type="text" class="form-control" id="id" name="id" value="{$item->id}" readonly>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{$item->name}">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="{$item->price}">
            </div>
            <button type="submit" class="btn btn-primary">Speichern</button>
        </form>
    {else}
        <p>Nothing found :(</p>
    {/if}

    <a href="/">Zurück</a>
{/block}