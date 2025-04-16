<!-- components/confirm-modal.blade.php -->
<div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black/30 hidden" onclick="closeModalIfClickedOutside(event)">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full" onclick="event.stopPropagation()">
        <h2 class="text-xl font-semibold mb-4">Are you sure?</h2>
        <p class="text-gray-600 mb-6">This action cannot be undone.</p>
        <form id="confirmForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-4">
                <button type="button" class="btn btn-primary py-2" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn btn-error py-2">Delete</button>
            </div>
        </form>
    </div>
</div>


<script>
    document.getElementById('confirmForm').addEventListener('submit', function () {
        closeModal();
    });

    function openModal(deleteUrl) {
        document.getElementById('confirmForm').action = deleteUrl;
        document.getElementById('confirmModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('confirmModal').classList.add('hidden');
    }

    function closeModalIfClickedOutside(event) {
        const modalContent = document.querySelector('#confirmModal > div');
        if (!modalContent.contains(event.target)) {
            closeModal();
        }
    }

</script>
