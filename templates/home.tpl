{extends file="base.tpl"}

{block name="title"}
    {$title}
{/block}

{block name="body"}
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Artikelnumer</th>
                <th>Name</th>
                <th>Preis</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$items item=item}
                <tr>
                    <td>{$item->id}</td>
                    <td>{$item->name}</td>
                    <td>{$item->price / 100}€</td>
                    <td>
                        <a href="delete/{$item->id}" class="btn btn-danger btn-sm" title="Löschen">
                            <i class="bi bi-trash3"></i>
                        </a>
                        <a href="read/{$item->id}" class="btn btn-info btn-sm" title="Details">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>

    <form action="/create" method="post" class="row mt-4">
        <div class="col-md-2 mb-2">
            <label for="item-id" class="form-label d-md-none">Artikelnumer</label>
            <input type="text" class="form-control" id="item-id" name="id" placeholder="Artikelnumer" required />
        </div>
        <div class="col-md-5 mb-2">
            <label for="item-name" class="form-label d-md-none">Name</label>
            <input type="text" class="form-control" id="item-name" name="name" placeholder="Name" required />
        </div>
        <div class="col-md-3 mb-2">
            <label for="item-price" class="form-label d-md-none">Preis</label>
            <input type="text" class="form-control" id="item-price" name="price" placeholder="Preis" required />
        </div>
        <div class="col-md-2 mb-2">
            <span class="d-md-none form-label">&nbsp;</span>
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-plus-square"></i> Hinzufügen
            </button>
        </div>
    </form>

{/block}