<!-- Multi-Step Location Wizard Modal -->
<div id="locationWizard" class="wizard-modal">
    <div class="wizard-content">
        <div class="wizard-header">
            <h3>Find Property by City Location</h3>
            <button class="close-wizard" onclick="closeWizard()">&times;</button>
        </div>
        
        <!-- Progress Bar -->
        <div class="wizard-progress">
            <div class="progress-step active" data-step="1">1<span>City</span></div>
            <div class="progress-step" data-step="2">2<span>Category</span></div>
            <div class="progress-step" data-step="3">3<span>Type</span></div>
            <div class="progress-step" data-step="4">4<span>Developer</span></div>
        </div>

        <div class="wizard-body">
            <!-- Step 1: Select City -->
            <div class="wizard-step active" id="step1">
                <h4>Select City Location</h4>
                <div class="wizard-grid" id="cityGrid">
                    <!-- Cities will be loaded here -->
                </div>
            </div>

            <!-- Step 2: Category -->
            <div class="wizard-step" id="step2">
                <h4>Choose Category</h4>
                <div class="wizard-grid" id="categoryGrid">
                    <!-- Categories will be loaded here -->
                </div>
                <button class="wizard-back" onclick="goToStep(1)">Back</button>
            </div>

            <!-- Step 3: Type -->
            <div class="wizard-step" id="step3">
                <h4>Property Type</h4>
                <div class="wizard-grid" id="typeGrid">
                    <!-- Types will be loaded here -->
                </div>
                <button class="wizard-back" onclick="goToStep(2)">Back</button>
            </div>

            <!-- Step 4: Developer -->
            <div class="wizard-step" id="step4">
                <h4>Choose Developer</h4>
                <div class="wizard-grid" id="devGrid">
                    <!-- Developers will be loaded here -->
                </div>
                <button class="wizard-back" onclick="goToStep(3)">Back</button>
            </div>
        </div>
    </div>
</div>

<style>
.wizard-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.85);
    display: none;
    z-index: 99999 !important;
    backdrop-filter: blur(8px);
    align-items: center;
    justify-content: center;
}

.wizard-content {
    background: #fff;
    width: 95%;
    max-width: 800px;
    height: auto;
    max-height: 90vh;
    border-radius: 20px;
    overflow: hidden;
    animation: zoomIn 0.3s ease-out;
    box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
    display: flex;
    flex-direction: column;
}

@keyframes zoomIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

.wizard-header {
    background: #c00415;
    color: #fff;
    padding: 20px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.wizard-header h3 { margin: 0; font-size: 22px; font-weight: 700; color: #fff; }
.close-wizard { background: none; border: none; color: #fff; font-size: 30px; cursor: pointer; }

.wizard-progress {
    display: flex;
    background: #f8f9fa;
    padding: 20px;
    border-bottom: 1px solid #eee;
}

.progress-step {
    flex: 1;
    text-align: center;
    font-size: 13px;
    color: #999;
    position: relative;
    font-weight: 600;
}

.progress-step span { display: block; margin-top: 5px; }
.progress-step.active { color: #c00415; }
.progress-step.active::after {
    content: '';
    position: absolute;
    bottom: -20px;
    left: 0;
    width: 100%;
    height: 3px;
    background: #c00415;
}

.wizard-body { 
    padding: 30px !important; 
    min-height: 300px !important; 
    overflow-y: auto !important; 
    flex: 1 !important;
    scrollbar-width: thin !important;
    scrollbar-color: #c00415 #f0f0f0 !important;
}

.wizard-body::-webkit-scrollbar {
    width: 6px;
}

.wizard-body::-webkit-scrollbar-track {
    background: #f0f0f0;
}

.wizard-body::-webkit-scrollbar-thumb {
    background-color: #c00415 !important;
    border-radius: 10px !important;
}
.wizard-step { display: none; }
.wizard-step.active { display: block; animation: fadeIn 0.4s; }

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.wizard-step h4 { margin-top: 0; margin-bottom: 30px; text-align: center; color: #333; font-weight: 700; }

.wizard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 20px;
}

.wizard-card {
    background: #fff;
    border: 2px solid #f0f0f0;
    padding: 25px 15px;
    border-radius: 15px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.wizard-card:hover {
    border-color: #c00415;
    background: #fff5f6;
    transform: translateY(-5px);
    box-shadow: 0 10px 15px -3px rgba(192, 4, 21, 0.1);
}

.wizard-card i { font-size: 35px; color: #c00415; }
.wizard-card span { font-weight: 600; color: #444; }

.wizard-back {
    margin-top: 30px !important;
    background: #f0f0f0 !important;
    border: 1px solid #ddd !important;
    padding: 12px 30px !important;
    border-radius: 8px !important;
    cursor: pointer !important;
    font-weight: 600 !important;
    width: 100% !important;
    color: #444 !important;
    transition: all 0.3s ease !important;
    display: block !important;
}

.wizard-back:hover { background: #ddd; }

/* Responsive */
@media (max-width: 600px) {
    .wizard-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
    .wizard-body { padding: 15px; }
    .wizard-header { padding: 15px 20px; }
    .wizard-header h3 { font-size: 18px; }
    .wizard-progress { padding: 10px; }
    .progress-step { font-size: 11px; }
    .wizard-content { width: 98%; max-height: 95vh; }
    .wizard-back { margin-top: 20px; padding: 10px; }
}
</style>

<script>
let selection = {
    city: '',
    category_id: '',
    subcategory_id: '',
    developer: ''
};

function openWizard() {
    document.getElementById('locationWizard').style.display = 'flex';
    goToStep(1);
    loadCities();
}

function closeWizard() {
    document.getElementById('locationWizard').style.display = 'none';
}

function goToStep(step) {
    // Hide all steps
    document.querySelectorAll('.wizard-step').forEach(s => s.classList.remove('active'));
    // Show current step
    document.getElementById('step' + step).classList.add('active');
    
    // Update progress bar
    document.querySelectorAll('.progress-step').forEach(ps => {
        if(ps.dataset.step <= step) ps.classList.add('active');
        else ps.classList.remove('active');
    });
}

const WIZARD_API = '<?= SITE_URL; ?>get_wizard_data.php';

function loadCities() {
    const grid = document.getElementById('cityGrid');
    grid.innerHTML = '<p class="text-center">Loading locations...</p>';
    fetch(WIZARD_API + '?action=get_locations')
        .then(res => res.json())
        .then(data => {
            grid.innerHTML = '';
            if(!data || data.length === 0) {
                grid.innerHTML = '<p class="text-center">No cities with active products found.</p>';
                return;
            }
            data.forEach(item => {
                const card = document.createElement('div');
                card.className = 'wizard-card';
                card.innerHTML = `<i class="fa fa-map-marker-alt"></i><span>${item.location}</span>`;
                card.onclick = () => selectCity(item.location);
                grid.appendChild(card);
            });
        }).catch(err => { 
            grid.innerHTML = '<p class="text-center text-danger">Error loading cities. Please refresh or check connection.</p>';
            console.error('Wizard Fetch Error:', err);
        });
}

function selectCity(city) {
    selection.city = city;
    loadCategories();
    goToStep(2);
}

function loadCategories() {
    const grid = document.getElementById('categoryGrid');
    grid.innerHTML = '<p class="text-center">Loading categories...</p>';
    fetch(`${WIZARD_API}?action=get_categories&city=${encodeURIComponent(selection.city)}`)
        .then(res => res.json())
        .then(data => {
            grid.innerHTML = '';
            if(!data || data.length === 0) {
                grid.innerHTML = '<p class="text-center">No categories found for this city.</p>';
                return;
            }
            data.forEach(item => {
                const card = document.createElement('div');
                card.className = 'wizard-card';
                const icon = item.name.toLowerCase().includes('comm') ? 'fa-building' : 'fa-home';
                card.innerHTML = `<i class="fa ${icon}"></i><span>${item.name}</span>`;
                card.onclick = () => selectCategory(item.id);
                grid.appendChild(card);
            });
        }).catch(err => { grid.innerHTML = '<p class="text-center text-danger">Error loading categories.</p>'; });
}

function selectCategory(catId) {
    selection.category_id = catId;
    loadTypes();
    goToStep(3);
}

function loadTypes() {
    const grid = document.getElementById('typeGrid');
    grid.innerHTML = '<p class="text-center">Loading property types...</p>';
    fetch(`${WIZARD_API}?action=get_property_types&city=${encodeURIComponent(selection.city)}&category_id=${selection.category_id}`)
        .then(res => res.json())
        .then(data => {
            grid.innerHTML = '';
            if(!data || data.length === 0) {
                grid.innerHTML = '<p class="text-center">No types found for this selection.</p>';
                return;
            }
            data.forEach(item => {
                const card = document.createElement('div');
                card.className = 'wizard-card';
                card.innerHTML = `<i class="fa fa-layer-group"></i><span>${item.property_type}</span>`;
                card.onclick = () => selectType(item.id);
                grid.appendChild(card);
            });
        }).catch(err => { grid.innerHTML = '<p class="text-center text-danger">Error loading types.</p>'; });
}

function selectType(subcatId) {
    selection.subcategory_id = subcatId;
    loadDevelopers();
    goToStep(4);
}

function loadDevelopers() {
    const grid = document.getElementById('devGrid');
    grid.innerHTML = '<p class="text-center">Loading developers...</p>';
    fetch(`${WIZARD_API}?action=get_developers&city=${encodeURIComponent(selection.city)}&category_id=${selection.category_id}&subcategory_id=${selection.subcategory_id}`)
        .then(res => res.json())
        .then(data => {
            grid.innerHTML = '';
            if(!data || data.length === 0) {
                grid.innerHTML = '<p class="text-center">No developers found for this criteria.</p>';
                return;
            }
            data.forEach(item => {
                const card = document.createElement('div');
                card.className = 'wizard-card';
                card.innerHTML = `<i class="fa fa-user-tie"></i><span>${item.developer}</span>`;
                card.onclick = () => finishWizard(item.developer);
                grid.appendChild(card);
            });
        }).catch(err => { grid.innerHTML = '<p class="text-center text-danger">Error loading developers.</p>'; });
}

function finishWizard(dev) {
    selection.developer = dev;
    const url = `<?= SITE_URL; ?>search_result.php?query=${encodeURIComponent(dev)}&location=${encodeURIComponent(selection.city)}&category_id=${selection.category_id}&subcategory_id=${selection.subcategory_id}`;
    window.location.href = url;
}
</script>
