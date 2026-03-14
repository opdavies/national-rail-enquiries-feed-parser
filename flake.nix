{
  inputs = {
    devshell.url = "github:numtide/devshell";
    nixpkgs.url = "github:NixOS/nixpkgs/nixos-23.05";
  };

  outputs = inputs@{ flake-parts, ... }:
    flake-parts.lib.mkFlake { inherit inputs; } {
      imports = [ inputs.devshell.flakeModule ];

      systems = [ "x86_64-linux" ];

      perSystem = { config, self', inputs', pkgs, system, ... }: {
        formatter = pkgs.nixpkgs-fmt;

        devshells.default = {
          packages = with pkgs; [ php80 php80Packages.composer ];

          commands =
            let
              inherit (pkgs) writeShellApplication;
            in
            [
              {
                package = writeShellApplication {
                  name = "run-tests";
                  text = ''vendor/bin/pest "$@"'';
                };

                help = "runs the automated tests";
              }

              {
                package = writeShellApplication {
                  name = "setup";
                  text = ''
                    composer install
                  '';
                };

                help = "sets up the project for local development";
              }
            ];
        };
      };
    };
}
