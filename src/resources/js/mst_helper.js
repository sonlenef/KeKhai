class MSTHelper {
    constructor() {
        this.URL = "https://masothue.com";
    }

    async GetTaxInfomation(taxCode) {
        try {
            const responseData = await $.ajax({
                url: `${this.URL}/Ajax/Search`,
                type: "POST",
                data: {
                    type: "auto",
                    "force-search": "1",
                    q: taxCode
                },
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    origin: this.URL
                }
            });

            if (responseData.success === 0) {
                return {
                    success: false,
                    message: responseData.message
                };
            } else {
                const urlInfo = `${this.URL}${responseData.url}?t=${Date.now()}`;
                const htmlData = await $.ajax({
                    url: urlInfo,
                    type: "GET"
                });

                const page = $(htmlData);
                const tableInfo = page.find(".table-taxinfo").html();
                const name = page.find("thead tr").text().replace(/\n/g, "");
                const allNodes = page.find("td").toArray().map(node => $(node).text().trim());

                const taxInfo = {
                    success: true,
                    name: name,
                    mst: allNodes[1],
                    address: allNodes.length === 12 ? "" : allNodes[3],
                    deputy: allNodes.length === 12 ? allNodes[3] : allNodes[5],
                    date_actived: allNodes.length === 12 ? allNodes[5] : allNodes[7],
                    by_manager: allNodes.length === 12 ? allNodes[7] : allNodes[9],
                    status: allNodes.length === 12 ? allNodes[9] : allNodes[11],
                    note: allNodes[allNodes.length - 2].split(".")[0].replace(/\n/g, "")
                };

                return taxInfo;
            }
        } catch (error) {
            console.error("An error occurred:", error);
            return { success: false, message: "An error occurred while fetching tax information." };
        }
    }
}