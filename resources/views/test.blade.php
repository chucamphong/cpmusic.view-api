<?php $items = [] ?>

            // Cách viết thông thường
            <?php foreach ($items as $item) { ?>
                <div class='item-box'>
                    <h3>Item name: <?php echo $item->name; ?></h3>
                    <?php if ($item->amount ==0) { ?>
                        <p>Out of order</p>
                    <?php } else { ?>
                        <p><?php echo $item->amount ?></p>
                    <?php } ?>
                </div>
            <?php } ?>


            // Sử dụng Blade template
            @foreach ($items as $item)
                <div class='item-box'>
                    <h3>Item name: {{ $item->name }}</h3>
                    @if ($item->amount == 0)
                        <p>Out of order</p>
                    @else
                        <p>{{ $item->amount }}</p>
                    @endif
                </div>
            @endforeach
