<?php $__env->startSection('title', 'Contact Us'); ?>
<?php $__env->startSection('body'); ?>

<form id="deleteForm" action="<?php echo e(route('delete.contact')); ?>" method="post">
    <?php echo csrf_field(); ?>
    <?php if(isset($contacts) && is_array($contacts) && count($contacts) > 0): ?>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Message</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($contact->id); ?></td>
                <td><?php echo e($contact->name); ?></td>
                <td><?php echo e($contact->email); ?></td>
                <td><?php echo e($contact->phone); ?></td>
                <td><?php echo e($contact->message); ?></td>
                <td>
                    <button type="submit" class="btn btn-danger" onclick="vaporizeThis()" name="contactIdToDelete" value="<?php echo e($contact->id); ?>">Delete</button>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No messages has arrived yet.</p>
    <?php endif; ?>
</form>


<script>
    function vaporizeThis() {
        if (confirm('Are you sure you want to delete this message?')) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("template.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel-Input-and-Delete-Contact-Us-master\resources\views/data.blade.php ENDPATH**/ ?>