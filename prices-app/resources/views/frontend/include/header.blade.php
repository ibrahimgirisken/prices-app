<nav class="navbar bg-dark navbar-expand-lg fixed-top bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Platform Fiyat Analizi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" id="getPrices" href="/prices">Ürünleri Listele</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="updateProducts" href="/update-prices">Ürünleri Güncelle</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="updateCompanyProducts" href="#">Firma Ürünlerini Güncelle</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            XML
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/xml-update" id="updateXmlProduct" href="#">XML Ürün Güncelle</a></li>
            <li><a class="dropdown-item" href="/xml-edit" id="editXmlProduct" href="#">XML Ürün Düzenleme</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ayarlar
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/department-edit">Departman Ekle Güncelle</a></li>
            <li><a class="dropdown-item" href="/department-earning-edit">Departmana Göre Kazanç Güncelle</a></li>
            <li><a class="dropdown-item" href="/cargo-edit">Kargo Desi Güncelle</a></li>
            <li><a class="dropdown-item" href="/commission-edit">Komisyon Oranı Güncelle</a></li>
            <li><a class="dropdown-item" href="/currency-edit">Kur-Iskonto Güncelle</a></li>
            <li><a class="dropdown-item" href="/features-edit">Ürün Grupları Departman Güncelle</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>