<script setup lang="ts">
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { fetchKambing, parseCategory } from "../helpers";

const kambing = ref({ category: 0 } as any);
const router = useRouter();
const route = useRoute();
const uploadedFile = ref(null as string | null);

const handleSave = async () => {
  try {
    if (uploadedFile.value) {
      kambing.value.image = uploadedFile.value.split("base64,")?.[1];
    }

    const resp = await fetch(
      `${import.meta.env.VITE_APP_BASE_URL}/api/kambings`,
      {
        method: "post",
        headers: { "content-type": "application/json" },
        body: JSON.stringify(kambing.value),
      }
    );

    if (resp.status !== 200 && resp.status !== 201) {
      throw await resp.text();
    }

    router.push("/");
  } catch (e) {
    console.error(e);
  }
};

const filterCat = (e: Event) => {
  // alert((e.target as HTMLInputElement).value);

  let val = null;

  if (!isNaN(parseInt((e.target as HTMLInputElement).value))) {
    val = parseInt((e.target as HTMLInputElement).value);
  }

  kambing.value.category = val;
};

const fetchKambingData = async () => {
  if (!isNaN(parseInt((route.params as any)?.id ?? ""))) {
    const d = await fetchKambing({ id: (route.params as any)?.id });

    if (d) {
      kambing.value = d;
    }
  }
};

const handleInputFile = (e: Event) => {
  const f = (e.target as HTMLInputElement).files?.[0];

  const fr = new FileReader();

  if (f) {
    fr.readAsDataURL(f);

    fr.onload = (_) => {
      const d = fr.result;

      // alert(d);
      uploadedFile.value = d as string;
    };

    fr.onerror = (e) => {
      console.error(e);
    };
  }
};

fetchKambingData();
</script>

<template>
  <div class="p-3">
    <div class="d-flex">
      <div>
        <h4>Detail Kambing</h4>
        <button
          class="btn btn-sm btn-primary"
          @click="
            () => {
              handleSave();
            }
          "
        >
          Save
        </button>
      </div>
    </div>
    <div><strong>Nama</strong></div>
    <div>
      <input
        class="form-control form-control-sm"
        placeholder="Nama..."
        :value="kambing?.name ?? ''"
        @blur="e=>{
        kambing.name = (e.target as HTMLInputElement).value
      }"
      />
    </div>
    <div><strong>Harga</strong></div>
    <div>
      <input
        class="form-control form-control-sm"
        type="number"
        placeholder="Harga..."
        :value="kambing?.price ?? ''"
        @blur="e=>{
        kambing.price = parseFloat((e.target as HTMLInputElement).value)
      }"
      />
    </div>
    <div>
      <strong>Kategori ({{ parseCategory(kambing?.category ?? 0) }})</strong>
    </div>

    <select @input="filterCat">
      <option :value="0">Kecil</option>
      <option :value="1">Sedang</option>
      <option :value="2">Super</option>
    </select>

    <div><h4>Image</h4></div>

    <div>
      <input type="file" @input="handleInputFile" accept="image/*" />
    </div>

    <div class="d-flex justify-content-center w-100" v-if="uploadedFile">
      <img :src="`${uploadedFile}`" style="max-width: 50vw" />
    </div>
  </div>
</template>
