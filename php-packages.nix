{composerEnv, fetchurl, fetchgit ? null, fetchhg ? null, fetchsvn ? null, noDev ? false}:

let
  packages = {
    "adbario/php-dot-notation" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "adbario-php-dot-notation-a94ce4493d19ea430baa8d7d210a2c9bd7129fc2";
        src = fetchurl {
          url = "https://api.github.com/repos/adbario/php-dot-notation/zipball/a94ce4493d19ea430baa8d7d210a2c9bd7129fc2";
          sha256 = "1n6cghr8vdw6jzjqqs2icdy70cn0h4089agv8xvwqgr44krjsl57";
        };
      };
    };
    "doctrine/annotations" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "doctrine-annotations-253dca476f70808a5aeed3a47cc2cc88c5cab915";
        src = fetchurl {
          url = "https://api.github.com/repos/doctrine/annotations/zipball/253dca476f70808a5aeed3a47cc2cc88c5cab915";
          sha256 = "1b9hv84p3ni0xv76kb0pm17agaqnh21nw1wnv6y2kb4idpk0xvfm";
        };
      };
    };
    "doctrine/collections" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "doctrine-collections-2b44dd4cbca8b5744327de78bafef5945c7e7b5e";
        src = fetchurl {
          url = "https://api.github.com/repos/doctrine/collections/zipball/2b44dd4cbca8b5744327de78bafef5945c7e7b5e";
          sha256 = "0ch52jxr7kpv64dmg4xbzlnsspsc0ykm227h2hvr40clalhdw6n8";
        };
      };
    };
    "doctrine/deprecations" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "doctrine-deprecations-d4fe3e6fd9bb9e72557a19674f44d8ac7db4c6ca";
        src = fetchurl {
          url = "https://api.github.com/repos/doctrine/deprecations/zipball/d4fe3e6fd9bb9e72557a19674f44d8ac7db4c6ca";
          sha256 = "1mz0c1cakkz70yrslyg5fbdjprk8ybi7q9qvl4d1h7n6bl41ajd1";
        };
      };
    };
    "doctrine/lexer" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "doctrine-lexer-861c870e8b75f7c8f69c146c7f89cc1c0f1b49b6";
        src = fetchurl {
          url = "https://api.github.com/repos/doctrine/lexer/zipball/861c870e8b75f7c8f69c146c7f89cc1c0f1b49b6";
          sha256 = "0q25i1d6nqkrj4yc35my6b51kn2nksddhddm13vkc7ilkkn20pg7";
        };
      };
    };
    "psr/cache" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "psr-cache-213f9dbc5b9bfbc4f8db86d2838dc968752ce13b";
        src = fetchurl {
          url = "https://api.github.com/repos/php-fig/cache/zipball/213f9dbc5b9bfbc4f8db86d2838dc968752ce13b";
          sha256 = "0iv5miiz152y48zxdkw97v7swwpc5mixaj9iynm2bq52skvcczjb";
        };
      };
    };
    "psr/container" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "psr-container-c71ecc56dfe541dbd90c5360474fbc405f8d5963";
        src = fetchurl {
          url = "https://api.github.com/repos/php-fig/container/zipball/c71ecc56dfe541dbd90c5360474fbc405f8d5963";
          sha256 = "1mvan38yb65hwk68hl0p7jymwzr4zfnaxmwjbw7nj3rsknvga49i";
        };
      };
    };
    "psr/log" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "psr-log-f16e1d5863e37f8d8c2a01719f5b34baa2b714d3";
        src = fetchurl {
          url = "https://api.github.com/repos/php-fig/log/zipball/f16e1d5863e37f8d8c2a01719f5b34baa2b714d3";
          sha256 = "14h8r5qwjvlj7mjwk6ksbhffbv4k9v5cailin9039z1kz4nwz38y";
        };
      };
    };
    "symfony/cache" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-cache-0fe08ee32cec2748fbfea10c52d3ee02049e0f6b";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/cache/zipball/0fe08ee32cec2748fbfea10c52d3ee02049e0f6b";
          sha256 = "1d8nzvha3c15zyhfmdwj4i6b3pxmifdfylq4klygamfbz6n38dgl";
        };
      };
    };
    "symfony/cache-contracts" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-cache-contracts-517c3a3619dadfa6952c4651767fcadffb4df65e";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/cache-contracts/zipball/517c3a3619dadfa6952c4651767fcadffb4df65e";
          sha256 = "0sj22xfwqyvwknshz86fggdqpszmmd4bqvwqqiqdrbzmbn2bk5wc";
        };
      };
    };
    "symfony/deprecation-contracts" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-deprecation-contracts-26954b3d62a6c5fd0ea8a2a00c0353a14978d05c";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/deprecation-contracts/zipball/26954b3d62a6c5fd0ea8a2a00c0353a14978d05c";
          sha256 = "1wlaj9ngbyjmgr92gjyf7lsmjfswyh8vpbzq5rdzaxjb6bcsj3dp";
        };
      };
    };
    "symfony/polyfill-ctype" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-polyfill-ctype-a3cc8b044a6ea513310cbd48ef7333b384945638";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/polyfill-ctype/zipball/a3cc8b044a6ea513310cbd48ef7333b384945638";
          sha256 = "1gwalz2r31bfqldkqhw8cbxybmc1pkg74kvg07binkhk531gjqdn";
        };
      };
    };
    "symfony/polyfill-intl-grapheme" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-polyfill-intl-grapheme-380872130d3a5dd3ace2f4010d95125fde5d5c70";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/polyfill-intl-grapheme/zipball/380872130d3a5dd3ace2f4010d95125fde5d5c70";
          sha256 = "024lq9m6c19zmjml194k8y27ff8j7igcz92hj5rh2fd2hxax8fy6";
        };
      };
    };
    "symfony/polyfill-intl-normalizer" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-polyfill-intl-normalizer-3833d7255cc303546435cb650316bff708a1c75c";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/polyfill-intl-normalizer/zipball/3833d7255cc303546435cb650316bff708a1c75c";
          sha256 = "0qrq26nw97xfcl0p8x4ria46lk47k73vjjyqiklpw8w5cbibsfxj";
        };
      };
    };
    "symfony/polyfill-mbstring" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-polyfill-mbstring-6d857f4d76bd4b343eac26d6b539585d2bc56493";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/polyfill-mbstring/zipball/6d857f4d76bd4b343eac26d6b539585d2bc56493";
          sha256 = "0g9a4jdc0gf7vilvz1yfyzj83bisaqa6j4sz0j9arwjzlc1p2708";
        };
      };
    };
    "symfony/polyfill-php73" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-polyfill-php73-0f68c03565dcaaf25a890667542e8bd75fe7e5bb";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/polyfill-php73/zipball/0f68c03565dcaaf25a890667542e8bd75fe7e5bb";
          sha256 = "1dxg0xfikmfk0jzspd7h9ap0kzkgkbb0sv3q48mgdkqnc8gz58wy";
        };
      };
    };
    "symfony/polyfill-php80" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-polyfill-php80-0cc9dd0f17f61d8131e7df6b84bd344899fe2608";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/polyfill-php80/zipball/0cc9dd0f17f61d8131e7df6b84bd344899fe2608";
          sha256 = "0bliap0hqz9ca7795ah9dlmispl0r67lsbs3s33awf677ql6amwk";
        };
      };
    };
    "symfony/polyfill-php81" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-polyfill-php81-4a4cfc2d253c21a5ad0e53071df248ed48c6ce5c";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/polyfill-php81/zipball/4a4cfc2d253c21a5ad0e53071df248ed48c6ce5c";
          sha256 = "01s1x2ak9c3idpigbdx7y6a9h2mfplh53131z0mr48wh9azn2s5q";
        };
      };
    };
    "symfony/property-access" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-property-access-111e7ed617509f1a9139686055d234aad6e388e0";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/property-access/zipball/111e7ed617509f1a9139686055d234aad6e388e0";
          sha256 = "0x2wy9zl19f2zny4lc4vvf3avgjx61318bxv3zv2p89xfx303rfb";
        };
      };
    };
    "symfony/property-info" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-property-info-a0396295ad585f95fccd690bc6a281e5bd303902";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/property-info/zipball/a0396295ad585f95fccd690bc6a281e5bd303902";
          sha256 = "1mp31xg8r4zw5hp696fgvcmzs9nnmw96125qhkf647pk1xbpixdw";
        };
      };
    };
    "symfony/serializer" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-serializer-460c5df9fb6c39d10d5b7f386e4feae4b6370221";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/serializer/zipball/460c5df9fb6c39d10d5b7f386e4feae4b6370221";
          sha256 = "1gw5vcgmlznkr9zcl4jhvmdivm9b821g7qa6vlp1ph2kap4mvfzs";
        };
      };
    };
    "symfony/service-contracts" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-service-contracts-d78d39c1599bd1188b8e26bb341da52c3c6d8a66";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/service-contracts/zipball/d78d39c1599bd1188b8e26bb341da52c3c6d8a66";
          sha256 = "1cgbn2yx2fyrc3c1d85vdriiwwifr1sdg868f3rhq9bh78f03z99";
        };
      };
    };
    "symfony/string" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-string-d9e72497367c23e08bf94176d2be45b00a9d232a";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/string/zipball/d9e72497367c23e08bf94176d2be45b00a9d232a";
          sha256 = "0k4vvcjfdp2dni8gzq4rn8d6n0ivd38sfna70lgsh8vlc8rrlhpf";
        };
      };
    };
    "symfony/translation-contracts" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-translation-contracts-acbfbb274e730e5a0236f619b6168d9dedb3e282";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/translation-contracts/zipball/acbfbb274e730e5a0236f619b6168d9dedb3e282";
          sha256 = "1r496j63a6q3ch0ax76qa1apmc4iqf41zc8rf6yn8vkir3nzkqr0";
        };
      };
    };
    "symfony/validator" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-validator-883667679d93d6c30f1b7490d669801712d3be2f";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/validator/zipball/883667679d93d6c30f1b7490d669801712d3be2f";
          sha256 = "1kx4m9pk62n34rk4ah49g1ay8w88aa7dcn2n95fyfxrq0gaydn1y";
        };
      };
    };
    "symfony/var-exporter" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-var-exporter-df56f53818c2d5d9f683f4ad2e365ba73a3b69d2";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/var-exporter/zipball/df56f53818c2d5d9f683f4ad2e365ba73a3b69d2";
          sha256 = "0iba1nx9vvyfcfsxnxffznq3zkadr2jj4q6pc4f7i9k5dmzqm68l";
        };
      };
    };
    "webmozart/assert" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "webmozart-assert-9be6926d8b485f55b9229203f962b51ed377ba68";
        src = fetchurl {
          url = "https://api.github.com/repos/webmozarts/assert/zipball/9be6926d8b485f55b9229203f962b51ed377ba68";
          sha256 = "018az13gjx9gipk7dl603v10jzx5jsyb22z40c2xy704mv09mp40";
        };
      };
    };
  };
  devPackages = {
    "doctrine/instantiator" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "doctrine-instantiator-0a0fa9780f5d4e507415a065172d26a98d02047b";
        src = fetchurl {
          url = "https://api.github.com/repos/doctrine/instantiator/zipball/0a0fa9780f5d4e507415a065172d26a98d02047b";
          sha256 = "00qv07k8hpl2nj5pmamzihflgc0yx04h0rcln2fy3bz65jd6kb5j";
        };
      };
    };
    "filp/whoops" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "filp-whoops-d2102955e48b9fd9ab24280a7ad12ed552752c4d";
        src = fetchurl {
          url = "https://api.github.com/repos/filp/whoops/zipball/d2102955e48b9fd9ab24280a7ad12ed552752c4d";
          sha256 = "1gskpdhiadd15di54y262kmdfwhglw88cy7iqv3gwm42aa3rkzng";
        };
      };
    };
    "myclabs/deep-copy" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "myclabs-deep-copy-07d290f0c47959fd5eed98c95ee5602db07e0b6a";
        src = fetchurl {
          url = "https://api.github.com/repos/myclabs/DeepCopy/zipball/07d290f0c47959fd5eed98c95ee5602db07e0b6a";
          sha256 = "0ch1sz2lki1qnb49r2zww7ryk6i4ckyr04p1p9hmiszfi9fr631y";
        };
      };
    };
    "nikic/php-parser" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "nikic-php-parser-dca41cd15c2ac9d055ad70dbfd011130757d1f82";
        src = fetchurl {
          url = "https://api.github.com/repos/nikic/PHP-Parser/zipball/dca41cd15c2ac9d055ad70dbfd011130757d1f82";
          sha256 = "1qiv7qp87p0p39yqdcffakvdb533gnx57iz966wv7hkhprqsn2lb";
        };
      };
    };
    "nunomaduro/collision" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "nunomaduro-collision-f05978827b9343cba381ca05b8c7deee346b6015";
        src = fetchurl {
          url = "https://api.github.com/repos/nunomaduro/collision/zipball/f05978827b9343cba381ca05b8c7deee346b6015";
          sha256 = "09bpw23vq3yyilrkd6k798igrg0ypryxpw2bfbdgjvjwhs4ndf29";
        };
      };
    };
    "pestphp/pest" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "pestphp-pest-5c56ad8772b89611c72a07e23f6e30aa29dc677a";
        src = fetchurl {
          url = "https://api.github.com/repos/pestphp/pest/zipball/5c56ad8772b89611c72a07e23f6e30aa29dc677a";
          sha256 = "1xmm27v3pki13slszk25ghhha71q87q0fb8qvr7h137g8sihf5bj";
        };
      };
    };
    "pestphp/pest-plugin" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "pestphp-pest-plugin-606c5f79c6a339b49838ffbee0151ca519efe378";
        src = fetchurl {
          url = "https://api.github.com/repos/pestphp/pest-plugin/zipball/606c5f79c6a339b49838ffbee0151ca519efe378";
          sha256 = "043n1wnzz6k2a809m0jkajy626dvbzkzfvlkbrkknldar4mzhcy2";
        };
      };
    };
    "phar-io/manifest" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phar-io-manifest-54750ef60c58e43759730615a392c31c80e23176";
        src = fetchurl {
          url = "https://api.github.com/repos/phar-io/manifest/zipball/54750ef60c58e43759730615a392c31c80e23176";
          sha256 = "0xas0i7jd6w4hknfmbwdswpzngblm3d884hy3rba0q2cs928ndml";
        };
      };
    };
    "phar-io/version" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phar-io-version-4f7fd7836c6f332bb2933569e566a0d6c4cbed74";
        src = fetchurl {
          url = "https://api.github.com/repos/phar-io/version/zipball/4f7fd7836c6f332bb2933569e566a0d6c4cbed74";
          sha256 = "0mdbzh1y0m2vvpf54vw7ckcbcf1yfhivwxgc9j9rbb7yifmlyvsg";
        };
      };
    };
    "phpstan/phpstan" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpstan-phpstan-37982d6fc7cbb746dda7773530cda557cdf119e1";
        src = fetchurl {
          url = "https://api.github.com/repos/phpstan/phpstan/zipball/37982d6fc7cbb746dda7773530cda557cdf119e1";
          sha256 = "1sppfnfq34afszh1aqnwpaarddrazrzj20lyf00j662973m5zbxb";
        };
      };
    };
    "phpunit/php-code-coverage" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpunit-php-code-coverage-85402a822d1ecf1db1096959413d35e1c37cf1a5";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/php-code-coverage/zipball/85402a822d1ecf1db1096959413d35e1c37cf1a5";
          sha256 = "04bj7hqydv7r2dnfsyayg37f1f5x0bv7m5b1vmnl50zlz2a1dl8j";
        };
      };
    };
    "phpunit/php-file-iterator" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpunit-php-file-iterator-cf1c2e7c203ac650e352f4cc675a7021e7d1b3cf";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/php-file-iterator/zipball/cf1c2e7c203ac650e352f4cc675a7021e7d1b3cf";
          sha256 = "1407d8f1h35w4sdikq2n6cz726css2xjvlyr1m4l9a53544zxcnr";
        };
      };
    };
    "phpunit/php-invoker" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpunit-php-invoker-5a10147d0aaf65b58940a0b72f71c9ac0423cc67";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/php-invoker/zipball/5a10147d0aaf65b58940a0b72f71c9ac0423cc67";
          sha256 = "1vqnnjnw94mzm30n9n5p2bfgd3wd5jah92q6cj3gz1nf0qigr4fh";
        };
      };
    };
    "phpunit/php-text-template" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpunit-php-text-template-5da5f67fc95621df9ff4c4e5a84d6a8a2acf7c28";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/php-text-template/zipball/5da5f67fc95621df9ff4c4e5a84d6a8a2acf7c28";
          sha256 = "0ff87yzywizi6j2ps3w0nalpx16mfyw3imzn6gj9jjsfwc2bb8lq";
        };
      };
    };
    "phpunit/php-timer" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpunit-php-timer-5a63ce20ed1b5bf577850e2c4e87f4aa902afbd2";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/php-timer/zipball/5a63ce20ed1b5bf577850e2c4e87f4aa902afbd2";
          sha256 = "0g1g7yy4zk1bidyh165fsbqx5y8f1c8pxikvcahzlfsr9p2qxk6a";
        };
      };
    };
    "phpunit/phpunit" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpunit-phpunit-b36f02317466907a230d3aa1d34467041271ef4a";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/phpunit/zipball/b36f02317466907a230d3aa1d34467041271ef4a";
          sha256 = "1qwjv3x1izza3a4gmixbgpz85ykhbbzlvyfyxha04c2r1kqb6c91";
        };
      };
    };
    "sebastian/cli-parser" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-cli-parser-2b56bea83a09de3ac06bb18b92f068e60cc6f50b";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/cli-parser/zipball/2b56bea83a09de3ac06bb18b92f068e60cc6f50b";
          sha256 = "18rr5nj0dm4wmfppybdrs2pfkzy5nabb1lik9r9a661f926q8xv9";
        };
      };
    };
    "sebastian/code-unit" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-code-unit-1fc9f64c0927627ef78ba436c9b17d967e68e120";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/code-unit/zipball/1fc9f64c0927627ef78ba436c9b17d967e68e120";
          sha256 = "04vlx050rrd54mxal7d93pz4119pas17w3gg5h532anfxjw8j7pm";
        };
      };
    };
    "sebastian/code-unit-reverse-lookup" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-code-unit-reverse-lookup-ac91f01ccec49fb77bdc6fd1e548bc70f7faa3e5";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/code-unit-reverse-lookup/zipball/ac91f01ccec49fb77bdc6fd1e548bc70f7faa3e5";
          sha256 = "1h1jbzz3zak19qi4mab2yd0ddblpz7p000jfyxfwd2ds0gmrnsja";
        };
      };
    };
    "sebastian/comparator" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-comparator-e4df00b9b3571187db2831ae9aada2c6efbd715d";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/comparator/zipball/e4df00b9b3571187db2831ae9aada2c6efbd715d";
          sha256 = "1asd1mgcdd7bzf63glhjfmvav2b0mgffjfrs6pba7g37ygbizqrb";
        };
      };
    };
    "sebastian/complexity" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-complexity-25f207c40d62b8b7aa32f5ab026c53561964053a";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/complexity/zipball/25f207c40d62b8b7aa32f5ab026c53561964053a";
          sha256 = "1k8w6z8zcym3y5s0riami9667s0gd206jr3za6pkbb90zzj6b76g";
        };
      };
    };
    "sebastian/diff" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-diff-ba01945089c3a293b01ba9badc29ad55b106b0bc";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/diff/zipball/ba01945089c3a293b01ba9badc29ad55b106b0bc";
          sha256 = "1c5xr3mfcf7jzrj0grbc7lapi60j42dcwjsjs1x8kn5willmz9mp";
        };
      };
    };
    "sebastian/environment" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-environment-830c43a844f1f8d5b7a1f6d6076b784454d8b7ed";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/environment/zipball/830c43a844f1f8d5b7a1f6d6076b784454d8b7ed";
          sha256 = "02045n3in01zk571v1phyhj0b2mvnvx8qnlqvw4j33r7qdd4clzn";
        };
      };
    };
    "sebastian/exporter" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-exporter-14c6ba52f95a36c3d27c835d65efc7123c446e8c";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/exporter/zipball/14c6ba52f95a36c3d27c835d65efc7123c446e8c";
          sha256 = "1cwxriixasi6ayrjlyn5n2c707rk0d6y9ckis7sx7pfbim6k8cra";
        };
      };
    };
    "sebastian/global-state" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-global-state-b6781316bdcd28260904e7cc18ec983d0d2ef4f6";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/global-state/zipball/b6781316bdcd28260904e7cc18ec983d0d2ef4f6";
          sha256 = "09f1bgxw943ia5gf72ybcx982qdbyyb0zdgpwsgfq325xk2a326r";
        };
      };
    };
    "sebastian/lines-of-code" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-lines-of-code-e1e4a170560925c26d424b6a03aed157e7dcc5c5";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/lines-of-code/zipball/e1e4a170560925c26d424b6a03aed157e7dcc5c5";
          sha256 = "1ycasbrcsmyqszihx730l9krh2inj72xkpvb2fqd5y5xn4r8va2g";
        };
      };
    };
    "sebastian/object-enumerator" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-object-enumerator-5c9eeac41b290a3712d88851518825ad78f45c71";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/object-enumerator/zipball/5c9eeac41b290a3712d88851518825ad78f45c71";
          sha256 = "11853z07w8h1a67wsjy3a6ir5x7khgx6iw5bmrkhjkiyvandqcn1";
        };
      };
    };
    "sebastian/object-reflector" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-object-reflector-b4f479ebdbf63ac605d183ece17d8d7fe49c15c7";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/object-reflector/zipball/b4f479ebdbf63ac605d183ece17d8d7fe49c15c7";
          sha256 = "0g5m1fswy6wlf300x1vcipjdljmd3vh05hjqhqfc91byrjbk4rsg";
        };
      };
    };
    "sebastian/recursion-context" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-recursion-context-539c6691e0623af6dc6f9c20384c120f963465a0";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/recursion-context/zipball/539c6691e0623af6dc6f9c20384c120f963465a0";
          sha256 = "0dqj07z08ma9d6a0b08ql87k5z5hbfzmwab15rd2vl1ngqlvdjn9";
        };
      };
    };
    "sebastian/resource-operations" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-resource-operations-05d5692a7993ecccd56a03e40cd7e5b09b1d404e";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/resource-operations/zipball/05d5692a7993ecccd56a03e40cd7e5b09b1d404e";
          sha256 = "186kqdsgsrdyz4j2sv5lgjyr9ykhgbkv8gvkmaqdq99c11qfjin2";
        };
      };
    };
    "sebastian/type" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-type-75e2c2a32f5e0b3aef905b9ed0b179b953b3d7c7";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/type/zipball/75e2c2a32f5e0b3aef905b9ed0b179b953b3d7c7";
          sha256 = "0bvfvb62qbpy2hzxs4bjzb0xhks6h3cp6qx96z4qlyz6wl2fa1w5";
        };
      };
    };
    "sebastian/version" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-version-c6c1022351a901512170118436c764e473f6de8c";
        src = fetchurl {
          url = "https://api.github.com/repos/sebastianbergmann/version/zipball/c6c1022351a901512170118436c764e473f6de8c";
          sha256 = "1bs7bwa9m0fin1zdk7vqy5lxzlfa9la90lkl27sn0wr00m745ig1";
        };
      };
    };
    "svanderburg/composer2nix" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "svanderburg-composer2nix-299caca4aac42d7639a42eb4dde951c010f6e91c";
        src = fetchurl {
          url = "https://api.github.com/repos/svanderburg/composer2nix/zipball/299caca4aac42d7639a42eb4dde951c010f6e91c";
          sha256 = "0vb7q4za6z89azz4c5v7hgcv9gblcpk7hffl6va7q5f27fyyhwy0";
        };
      };
    };
    "svanderburg/pndp" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "svanderburg-pndp-bc795b341d95c24bb577e0d7a4a37fde98b1cce8";
        src = fetchurl {
          url = "https://api.github.com/repos/svanderburg/pndp/zipball/bc795b341d95c24bb577e0d7a4a37fde98b1cce8";
          sha256 = "1y46wsccjwdkvs1c1bklwbp7crsg0axyr7ncdibbny1sr54xb24i";
        };
      };
    };
    "symfony/console" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-console-c3ebc83d031b71c39da318ca8b7a07ecc67507ed";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/console/zipball/c3ebc83d031b71c39da318ca8b7a07ecc67507ed";
          sha256 = "1vvdw2fg08x9788m50isspi06n0lhw6c6nif3di1snxfq0sgb1np";
        };
      };
    };
    "symfony/var-dumper" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-var-dumper-42f18f170aa86d612c3559cfb3bd11a375df32c8";
        src = fetchurl {
          url = "https://api.github.com/repos/symfony/var-dumper/zipball/42f18f170aa86d612c3559cfb3bd11a375df32c8";
          sha256 = "03nxn3j8v540bd95syl28y2hvllikf2r5z3ryhb49z3xbhxc1bw1";
        };
      };
    };
    "theseer/tokenizer" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "theseer-tokenizer-b7489ce515e168639d17feec34b8847c326b0b3c";
        src = fetchurl {
          url = "https://api.github.com/repos/theseer/tokenizer/zipball/b7489ce515e168639d17feec34b8847c326b0b3c";
          sha256 = "094535sv3nkr6kqf4v36k76vs83zlxlvbdccjifbiv3qg0h6m78y";
        };
      };
    };
  };
in
composerEnv.buildPackage {
  inherit packages devPackages noDev;
  name = "opdavies-national-rail-enquiries-feed-parser";
  src = composerEnv.filterSrc ./.;
  executable = false;
  symlinkDependencies = false;
  meta = {
    license = "MIT";
  };
}
