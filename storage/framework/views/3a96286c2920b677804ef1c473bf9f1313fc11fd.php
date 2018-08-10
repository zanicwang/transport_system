

<div class="all_locations_div">
    <label>All locations</label>
    <button class="btn">
        <i class="left_arrow"><</i>
    </button>
</div>

<div class="filter_div">
    <input type="text" placeholder="Filter"/>
    <a href="" class="btn btn-info btn-lg">
        <span class="glyphicon glyphicon-sort"></span> Sort
    </a>
</div>
afdeling
<div class="address_match_div">
    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="row">
        <label><?php echo e($order->address); ?>, <?php echo e($order->zipcode); ?> <?php echo e($order->town); ?></label>
        <select id="select" style="" onChange="location.href='update_delivered?town=<?php echo e($order->town); ?>&address=<?php echo e($order->address); ?>&color='+this.options[this.selectedIndex].style.backgroundColor">
            <option style="background-color:red">Aarhus</option>
            <option style="background-color:green">Viborg</option>
            <option style="background-color:blue">Videbak</option>
            <option style="background-color:darkred">Varde</option>
            <option style="background-color:lightgreen">Ulfborg</option>
            <option style="background-color:lightblue">Ringkobing</option>
            <option style="background-color:white">Not asigned</option>
            <option style="background-color:black">Delivered</option>
        </select>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="push_pins_div">
	<div class="row">
		<a onclick="location.href='remove_sidebar?town=all'">
			<img src="<?php echo e(asset('icon/unmark/unmark.png')); ?>" class="remove_img">
			<span>Not asigned</span>
		</a>
	</div>
	<div class="row">
		<a onclick="location.href='remove_sidebar?town=rin'">
			<img src="<?php echo e(asset('icon/rin/remove.png')); ?>" class="remove_img">
			<span>Rinkobing</span>
		</a>
	</div>
	<div class="row">
		<a onclick="location.href='remove_sidebar?town=aar'">
			<img src="<?php echo e(asset('icon/aar/remove.png')); ?>" class="remove_img">
			<span>Aarhus</span>
		</a>
	</div>
	<div class="row">
		<a onclick="location.href='remove_sidebar?town=var'" >
		<img src="<?php echo e(asset('icon/var/remove.png')); ?>" class="remove_img">
		<span>Varde</span>
		</a>
	</div>
	<div class="row">
		<a onclick="location.href='remove_sidebar?town=vib'" >
		<img src="<?php echo e(asset('icon/vib/remove.png')); ?>" class="remove_img">
		<span>Viborg</span>
		</a>
	</div>
	<div class="row">
		<a onclick="location.href='remove_sidebar?town=vid'" >
		<img src="<?php echo e(asset('icon/vid/remove.png')); ?>" class="remove_img">
		<span>Videbak</span>
		</a>
	</div>
	<div class="row">
		<a onclick="location.href='remove_sidebar?town=ulf'" >
		<img src="<?php echo e(asset('icon/ulf/remove.png')); ?>" class="remove_img">
		<span>Ulfborg</span>
		</a>
	</div>
	<div class="row">
		<a onclick="location.href='remove_sidebar?town=del'">
		<img src="<?php echo e(asset('icon/delivered/delivered.png')); ?>" class="remove_img">
		<span>Delivered</span>
		</a>
	</div>
</div>
