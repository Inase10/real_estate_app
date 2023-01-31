



    <script>

</script>
<section id="search" style="margin-top:20px;">
    <div class="container">
        <div class="col-md-11 mx-auto search-area shadow">
            <div class="row">
                <div class="col-md-3">
                    <label for="location">حسب الموقع</label>
                    <select class="form-select mb-2 border border-primary" id="location_search"  wire:model="search2">
                        <option value=""></option>
                        <option value="Riyadh">الرياض</option>
                        <option value="Makkah">مكة المكرمة </option>
                        <option value="Al Madinah">المدينة المنورة</option>
                        <option value="Al-Qassim">القصيم </option>
                        <option value="Eastern Province">المنطقة الشرقية</option>
                        <option value="Northern Borders">المنطقة الشمالية </option>
                        <option value="Al Jawf">الجوف</option>
                        <option value="Tabuk">تبوك</option>
                        <option value="Aseer">عسير</option>
                        <option value="Najran">نجران </option>
                        <option value="Al-Baha">الباحة </option>
                        <option value="Jizan">جازان </option>
                        <option value="Hail"> حائل </option>

                    </select>

                </div>
                <div class="col-md-3">
                    <label for="price">حسب نوع العرض</label>
                    <select class="form-select mb-2 border border-primary" wire:model="search">
                        <option value="">  </option>
                        <option value="Sale"> بيع</option>
                        <option value="rent"> إيجار</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="price">حسب السعر</label>
                    <select class="form-select mb-2 border border-primary"wire:model="search3">
                        <option value=">"> </option>
                        <option value="=">سعر محدد</option>
                        <option value="<=">أعلى سعر</option>
                        <option value=">=">أدنى سعر</option>
                    </select>
                    <input type="number" class="form-control" value="0"placeholder="100.000 SAR" wire:model="search4">
                </div>
                <div class="col-md-3">
                    <label for="price">حسب نوع العقار</label>
                    <select class="form-select mb-2 border border-primary" wire:model="search5">
                        <option value="">  </option>
                        <option value="apartment"> شقة</option>
                        <option value="chalet"> شاليه</option>
                        <option value="land"> أرض</option>
                        <option value="house"> بيت عربي</option>
                        <option value="office"> مكتب</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>
