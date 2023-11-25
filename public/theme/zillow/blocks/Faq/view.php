<div id="accordion">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <?php echo $block->setting('question1'); ?>
                </button>
            </h5>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <?php echo $block->setting('answer1'); ?>
            </div>
        </div>
    </div>

    <?php

    for ($i = 2; $i < 11; $i++) {
        if ($block->setting('question' . $i) == '') continue;
    ?>
        <div class="card">
            <div class="card-header" id="heading<?= $i ?>">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?= $i ?>" aria-expanded="false" aria-controls="collapse<?= $i ?>"> <?php echo $block->setting('question' . $i); ?>
                    </button>
                </h5>
            </div>
            <div id="collapse<?= $i ?>" class="collapse" aria-labelledby="heading<?= $i ?>" data-parent="#accordion">
                <div class="card-body">
                    <?php echo $block->setting('answer' . $i); ?>
                </div>
            </div>
        </div>
    <?php

    }

    ?>

</div>