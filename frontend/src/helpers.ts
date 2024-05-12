export const fetchKambings = async () => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_APP_BASE_URL}/api/kambings`
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return (await resp.json()) as any[];
  } catch (e) {
    return [];
  }
};

export const fetchKambing = async (params: { id?: any }) => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_APP_BASE_URL}/api/kambings/${params.id ?? ""}`
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return (await resp.json()) as any;
  } catch (e) {
    return [];
  }
};

export const parseCategory = (c: any) => {
  switch (c) {
    case 0:
      return "Kecil";
    case 1:
      return "Sedang";
    case 2:
      return "Super";
    default:
      return "";
  }
};
