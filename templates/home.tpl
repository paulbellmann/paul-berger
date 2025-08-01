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
        <div class="col-md-2">
            <input type="text" class="form-control" name="id" placeholder="Artikelnumer" required />
        </div>
        <div class="col-md-5">
            <input type="text" class="form-control" name="name" placeholder="Name" required />
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="price" placeholder="Preis" required />
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-plus-square"></i> Hinzufügen
            </button>
        </div>
    </form>

{/block}